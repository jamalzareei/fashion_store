<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExtraField;
use App\Models\ExtraFieldValue;
use App\Models\Image;
use App\Models\Manufactory;
use App\Models\Price;
use App\Models\Product;
use App\Models\Thumbnail;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['admin', 'seller']);
    }
    //
    public function index(Request $request, $title = null)
    {
        if (!$title) {
            $title = $request->title;
        }

        $user = Auth::user();

        // return Auth::user()->manufactory->manufacturerid;

        $products = Product::select('id', 'code', 'name', 'slug', 'seller_id', 'user_id', 'active_admin')
            ->with([
                'seller' => function ($query) {
                },
                'user' => function ($query) {
                },
            ])
            ->where(function ($search) use ($title) {
                $search
                    ->where('code', 'like', '%' . $title . '%')
                    ->orWhere('slug', 'like', '%' . $title . '%')
                    ->orWhere('name', 'like', '%' . $title . '%');
            })
            ->orderby('active_admin')
            ->orderby('active', 'desc')
            ->orderby('id', 'desc')
            ->paginate(20);

// return $products;
        return view('admin.pages-admin.list-products', [
            'products' => $products,
            'title' => 'لیست محصولات',
        ]);
    }

    public function changeStatus(Request $request, $id)
    {
        # code...
        $product = Product::where('id', $id)->first();

        $active = ($request->active) ? 1 : 0;

        if($active){
            $product->active_admin = 1;
        }else{
            $product->active_admin = 0;
        }

        $product->save();
        
        return $product;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت اپدیت گردید.',
                'status' => 'success',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.admin.products')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت اپدیت گردید.',
                'status' => 'success',
                'data' => '',
            ]);
        }
    }

    public function listPrice(Request $request, $slugProduct = null)
    {

        $product = Product::where('slug', $slugProduct)->with('prices')->first();
        $factory = Manufactory::where('user_login', auth()->user()->login)->first();
        $price = Price::where([
            'manufacturer_id' => $factory->manufacturerid,
            'productid' => $product->productid,
        ])->first();
        // return $price;
        return view('admin.pages-suppliers.list-price', [
            'product' => $product,
            'price' => $price,
            'title' => 'لیست قیمت محصول ' . $slugProduct,
        ]);
    }

    public function addPrice(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:kimiagar_products,productid',
            'price' => 'required|integer',
        ]);

        if (!Auth::check()) {
            return back()->with('noty', [
                'title' => '',
                'message' => 'اجازه دسترسی ندارید',
                'status' => 'error',
                'data' => '',
            ]);
        }
        $factory = Manufactory::where('user_login', auth()->user()->login)->first();

        Price::where('productid', $request->productid)->delete();

        Price::updateOrCreate([
            'manufacturer_id' => $factory->manufacturerid,
            'productid' => $request->productid,
        ], [
            'user_login' => auth()->user()->login,
            'price' => $request->price,
            'discount' => $request->discount,
            'start_date' => ($request->start_date) ? $request->start_date : '2019-09-26 00:00:00',
            'end_date' => ($request->end_date) ? $request->end_date : '2019-09-26 00:00:00',
            'quantity' => 1,
            'variantid' => 0,
            'old_price' => 0,
            'membership' => '',
            'installation_costs' => ($request->installation_costs) ? $request->installation_costs : '',
            'delivery_time' => ($request->delivery_time) ? $request->delivery_time : '',
            'avail' => $request->avail,
            'avail_type' => $request->avail_type,
        ]);

        $product = Product::where('productid', $request->productid)->with('prices')->first();
        // return $request->all();
        if ($request->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت اضافه گردید.',
                'status' => 'success',
                'data' => view('admin.components.product.list-price', ['prices' => $product->prices]),
                'redirectEdit' => '',
                'redirectList' => route('list.product.supplier'),
            ];
        }

        return back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }

    public function addProduct(Request $request)
    {
        // return 'ok';
        $categories = Category::orderBy('id')
            ->select('name', 'id')
            ->where('parent_id', 0)
            ->where('menu', '1')
            ->where('add_product', '1')
            ->where('active', '1')
            ->get();
;

        $lastproduct = Product::orderBy('id', 'desc')->first();
        $code = 1;
        if($lastproduct){
            $code = $lastproduct->id + 1;
        }
        // return $lastproduct;
        return view('admin.pages-admin.add-product', [
            'categories' => $categories,
            'code' => auth()->user()->id . '-' . $code,
            'title' => 'اضافه کردن محصول',
        ]);
    }

    public function addProductPost(Request $request, $slugProduct = null)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:products,code',
            'categories.0' => 'required|min:1', //'required|exists:kimiagar_categories,categoryid',
            // 'manufacturerid' => 'required|exists:kimiagar_manufacturers,manufacturerid',
            'imageUrl' => 'image|max:300|mimes:jpeg,jpg,png',
        ]);

        if (!Auth::check()) {
            return back()->with('noty', [
                'title' => '',
                'message' => 'اجازه دسترسی ندارید',
                'status' => 'error',
                'data' => '',
            ]);
        }

        $date = date('Y-m-d');
        $path = "uploads/products/$date";
        $photos = [$request->imageUrl];
        $photos = UploadService::saveFile($path, $photos);

        $product = Product::create([
            'name' => $request->name, 
            'code' => $request->code, 
            'user_id' => auth()->user()->id, 
            'seller_id' => 0, 
            'active' => 0,
            'active_admin' => 1, 
            'description_short' => '', 
            'description_full' => '', 
            'meta_description' => $request->meta_description, 
            'meta_keywords' => $request->meta_keywords,
        ]);

        $product->categories()->sync($request->categories);

        
        $iconOld = Image::where('imageable_id', $product->id)->where('imageable_type', 'App\Models\Product')->where('type', 'MAIN')->where('default_use', 'MAIN')->first();
        if($iconOld){
            UploadService::destroyFile($iconOld->path);
        }
        $image = Image::updateOrCreate(
            [
                'imageable_id' => $product->id,
                'type' => 'MAIN', 
                'default_use' => 'MAIN',
            ],
            [
                'path' => $photos, 
                'imageable_type' => 'App\Models\Product', 
                'imageable_id' => $product->id, 
                'type' => 'MAIN', 
                'active' => '1', 
                'default_use' => 'MAIN',
            ]
        );

        return [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.admin.product.edit', ['slug' => $product->slug]),
            'redirectList' => route('panel.admin.products'),
        ];
    }

    public function editProduct(Request $request, $slug)
    {
        $productid = Product::where('slug', $slug)->first()->productid;
        $product = Product::where('slug', $slug)
            ->with(['categories' => function ($query) use ($productid) {
                $query->with(['extrafields' => function ($extra) use ($productid) {
                    $extra->with(['extrafieldvalues' => function ($value) use ($productid) {
                        $value->where('productid', $productid);
                    }]);
                }]);
            }])
            ->with('images')
            ->with('thumbnail')
            ->with('prices')
            ->first();

        $record = true;
        $extrafields = [];
        foreach ($product->categories as $key => $item) {
            # code...

            if (($item->categoryid == 2127 || $item->categoryid == 2169)) {
                $extrafields_1 = ExtraField::where('category_id', null)
                    ->with(['extrafieldvalues' => function ($value) use ($productid) {
                        $value->where('productid', $productid);
                    }])->orderBy('orderby')->get();
            } else {
                $extrafields_1 = ExtraField::where('category_id', $item->categoryid)
                    ->with(['extrafieldvalues' => function ($value) use ($productid) {
                        $value->where('productid', $productid);
                    }])->orderBy('orderby')->get();
            }

            $col1 = collect($extrafields);
            $col2 = collect($extrafields_1);
            $extrafields = $col1->merge($col2);
            // }
        }

        // return $product->categories;
        $manufacturer = auth()->user()->manufactory;
        // return $manufacturerid;
        if ($product->manufacturerid != $manufacturer->manufacturerid) {
            return back()->with('noty', [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
            ]);
        }
        $categories = Category::orderBy('category')->select('category', 'categoryid', 'categoryid_path')->where('parentid', 0)->where('is_menu', 'Y')->where('is_add', 'Y')->where('avail', 'Y')->get();

        $suppliers = Manufactory::select('manufacturer', 'manufacturerid')
        // ->with(['merchants'=> function($query){
        //     $query->where('user_login', auth()->user()->login)->select('id','title');
        // }])
            ->whereHas('merchants', function ($query) {
                $query->where('user_login', auth()->user()->login);
            })
            ->get();

        $price = Price::where([
            'manufacturer_id' => $manufacturer->manufacturerid,
            'productid' => $product->productid,
        ])->first();
        // return $slug;

        // $uses = [
        //     'آشپزخانه','دستشویی و توالت','رختشوی خانه','حمام و دوش','هال و پذیرایی','خواب و نهارخوری',
        //     'کودک و مطالعه','لابی و سالن','پارکینگ و انباری','راه پله و بالکن','حیاط و بیرونی'
        // ];
        $uses = [
            'گروه دیوار داخلی' => 'آشپزخانه,دستشویی و توالت,حمام و دوش,رختشویی خانه',
            'گروه دیوار نما' => 'نمای ساختمان,دیوار حیاط',
            'گروه کف داخلی' => 'هال و پذیرایی,کودک و مطالعه,خواب و نهارخوری',
            // 'گروه دیوار ترافیکی' => 'لابی و سالن,اداری,تجاری,پارکینگ و انباری,راه پله و بالکن',
            'گروه کف ترافیکی' => 'لابی و سالن,اداری,تجاری,پارکینگ و انباری,راه پله و بالکن,حیاط و بیرونی',
            'حیاط و بیرونی' => 'حیاط و بیرونی',
        ];

        return view('admin.pages-suppliers.edit-product', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'product' => $product,
            'extrafields' => $extrafields,
            'price' => $price,
            'uses' => $uses,
            'title' => 'ویرایش محصول | ' . $product->product,
        ]);
    }

    public function editProductStep1(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:kimiagar_products,productid',
            'product' => 'required|string',
            'productcode' => 'required|string',
            // 'categories' => 'exists:kimiagar_categories,categoryid',
            // 'manufacturerid' => 'exists:kimiagar_manufacturers,manufacturerid',
        ]);
        // return $request->imageUrl;
        if ($request->imageUrl != 'undefined') {
            $request->validate([
                'imageUrl' => 'sometimes|image|max:300|mimes:jpeg,jpg',
            ]);
        }
        $manufactorer = Manufactory::where('user_login', auth()->user()->login)->first();
        $product = Product::where('productid', $request->productid)->first();

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
                'redirectList' => route('list.product.supplier'),
            ];
        }
        if ($product->manufacturerid != $manufactorer->manufacturerid) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
                'redirectList' => route('list.product.supplier'),
            ];
        }

        // return $request->categories;

        $product->product = $request->product;
        $product->productcode = $request->productcode;
        // $product->manufacturerid = $request->manufacturerid;
        $product->save();

        if ($request->categories[0]) {
            $product->categories()->sync($request->categories, ['main' => 'Y']);
            DB::table('kimiagar_products_categories')->where('productid', $product->productid)->update(['main' => 'Y']);
        }

        $thumbnail = Thumbnail::where('productid', $product->productid)->first();
        if ($request->imageUrl != 'undefined') {

            $date = date('Y-m-d');
            $path = "uploads/products/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);

            if ($thumbnail) {
                UploadService::destroyFile($thumbnail->image_path);
            }
            // Thumbnail::where('productid', $product->productid)->delete();
            Thumbnail::updateOrCreate(
                ['productid' => $product->productid],
                [
                    'image' => '0',
                    'image_path' => $photos,
                    'image_type' => 'image/png',
                    'variantid' => 0,
                ]);

            Image::create([
                'productid' => $product->productid,
                'image' => '0',
                'image_path' => $photos,
                'image_type' => 'image/png',
                'image_x' => 0,
                'image_y' => 0,
                'image_size' => 0,
                'alt' => $request->product,
                'avail' => 'Y',
                'orderby' => 0,
                'md5' => '0',
                'color' => '0',
                'color_name' => '0',
            ]);
        }
        $redirectAuto = '';
        if ($request->categories) {
            $redirectAuto = route('edit.product.supplier', ['slug' => $product->slug]);
        }

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
            'redirectList' => route('list.product.supplier'),
            'redirectAuto' => $redirectAuto,
        ];
    }

    public function editProductStep2(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:kimiagar_products,productid',
            'file' => ['required', 'image', 'max:300'],
        ]);

        // $image = $request->file('file');
        // $imageName = $image->getClientOriginalName();
        // $image->move(private_path('images'),$imageName);

        $date = date('Y-m-d');
        $path = "uploads/products/$request->productid/gallery/$date";
        $photos = [$request->file];
        $photos = UploadService::saveFile($path, $photos);

        // $imageUpload = new Image();
        // $imageUpload->local_home_id = $request->id;
        // $imageUpload->imageUrl = $photos;
        // $imageUpload->save();
        $imageUpload = Image::create([
            'productid' => $request->productid,
            'image' => '0',
            'image_path' => $photos,
            'image_type' => 'image/png',
            'image_x' => 0,
            'image_y' => 0,
            'image_size' => 0,
            'alt' => 'سرام پخش',
            'avail' => 'Y',
            'orderby' => 0,
            'md5' => '0',
            'color' => '0',
            'color_name' => '0',
        ]);

        //C:\wamp64\www\chabahar\resources\views\Admin\components\image-gallery-private-tour.blade.php
        return [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => (string) view('admin.components.image-gallery-product-suppliers', ['image' => $imageUpload]),
            // 'redirectEdit' => route('places.edit', ['id' => $place->id]),
            'redirectList' => route('list.product.supplier'),
        ];
    }

    public function editProductStep2Delete(Request $request, $id)
    {
        //
        $image = Image::where('imageid', $id)->first();

        UploadService::destroyFile($image->image_url);

        $image->delete();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        }
    }

    public function editProductStep3(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:kimiagar_products,productid',
        ]);

        // $merchant = Merchant::where('user_login', auth()->user()->login)->first();
        $manufactorer = Manufactory::where('user_login', auth()->user()->login)->first();
        $product = Product::where('productid', $request->productid)->first();

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
                'redirectList' => route('list.product.supplier'),
            ];
        }
        if ($product->manufacturerid != $manufactorer->manufacturerid) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
                'redirectList' => route('list.product.supplier'),
            ];
        }

        // return $request->categories;

        $product->descr = $request->descr;
        $product->fulldescr = $request->fulldescr;
        $product->avail = 1000;
        $product->save();
        // descr
        // fulldescr
        // weight
        // avail
        // low_avail_limit
        // min_amount

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',
            'redirectList' => route('list.product.supplier'),
        ];
    }

    public function editProductStep4(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:kimiagar_products,productid',
            // 'extra_filed' => ['sometimes', 'string'],
        ]);

        // return ($request->all());

        $manufactorer = Manufactory::where('user_login', auth()->user()->login)->first();
        $product = Product::where('productid', $request->productid)->first();

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
                'redirectList' => route('list.product.supplier'),
            ];
        }
        if ($product->manufacturerid != $manufactorer->manufacturerid) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('edit.product.supplier', ['slug' => $product->slug]),
                'redirectList' => route('list.product.supplier'),
            ];
        }

        // strpos('dscsd,',)

        // return $request->extra_filed;
        ExtraFieldValue::where('productid', $request->productid)->delete();
        foreach ($request->extra_filed as $key => $value) {
            if ($key == 6) {
                // $value = json_encode($value);
                $value_6 = '';
                foreach ($value as $row => $val) {
                    $value_6 .= $val . '|';
                }
                // return $value_6;
                $value = $value_6;
            }
            if ($value && $key) {
                ExtraFieldValue::create([
                    'productid' => $request->productid,
                    'fieldid' => $key,
                    'value' => $value,
                ]);

            }
        }

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => $request->productid . '',
            'redirectEdit' => '',
            'redirectList' => route('list.product.supplier'),
        ];
    }

    public function changeCategories(Request $request)
    {
        // return $request->all();
        # code...
        $request->validate([
            'categoryid' => 'required|exists:kimiagar_categories,categoryid',
        ]);
        $categories = Category::orderBy('category')->select('category', 'categoryid', 'categoryid_path')->where('parentid', $request->categoryid)->where('is_menu', 'Y')->where('avail', 'Y')->get();

        $data = '<option > -- انتخاب دسته بندی --</option>';
        foreach ($categories as $category) {

            $data .= '<option value="' . $category->categoryid . '">' . $category->category . '</option>';
        }

        return $data;
    }

    public function deleteProductPost(Request $request, $id)
    {
        $login = auth()->user()->login;
        $factory = Manufactory::where('user_login', $login)->first();

        $product = Product::where('productid', $id)->where('manufacturerid', $factory->manufacturerid)->delete();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('list.product.supplier')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }
}
