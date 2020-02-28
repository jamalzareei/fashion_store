<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExtraField;
use App\Models\ExtraFieldsProduct;
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

        $product->active = 1;
        if($active){
            $product->active_admin = 1;
        }else{
            $product->active_admin = 0;
        }

        $product->save();
        
        // return $product;
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
                'redirectList' => route('panel.admin.products'),
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

        
        $iconOld = Image::where('imageable_id', $product->id)
            ->where('imageable_type', 'App\Models\Product')
            ->where('type', 'MAIN')
            ->where('default_use', 'MAIN')
            ->first();
        if($iconOld){
            UploadService::destroyFile($iconOld->path);
            $iconOld = Image::where('imageable_id', $product->id)
            ->where('imageable_type', 'App\Models\Product')
            // ->where('type', 'MAIN')
            ->where('default_use', 'MAIN')
            ->delete();
        }
        $image = Image::updateOrCreate(
            [
                'imageable_id' => $product->id,
                'type' => 'MAIN', 
                // 'default_use' => 'MAIN',
                'imageable_type' => 'App\Models\Product', 
            ],
            [
                'path' => $photos, 
                'imageable_id' => $product->id, 
                'active' => '1', 
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
        $product = Product::where('slug', $slug)
            ->with('user')
            ->with('categories')
            ->with('seller')
            ->with('extrafields')
            ->with('image')
            ->with('images')
            ->with('prices')
            ->first();
        
            
        $categories = Category::orderBy('id')
            ->select('name', 'id')
            ->where('parent_id', 0)
            ->where('menu', '1')
            ->where('add_product', '1')
            ->where('active', '1')
            ->get();


        $extrafields = [];
        foreach ($product->categories as $key => $item) {
            # code...
            $prodict_id = $product->id;
            $extrafields = ExtraField::where('category_id', $item->id)
            ->with(['extrafieldsproduct'=> function($value) use($prodict_id){
                $value->where('product_id',$prodict_id);
            }])->orderBy('order')->get();

            // $col2 = collect($extrafields_1);
            // $extrafields= $col1->merge($col2);
        }

        // return $extrafields;

        return view('admin.pages-admin.edit-product', [
            'categories' => $categories,
            'product' => $product,
            'extrafields' => $extrafields,
            'title' => 'ویرایش محصول | ' . $product->name,
        ]);
    }

    public function editProductStep1(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string',
            'code' => 'required|string',
            // 'categories' => 'exists:kimiagar_categories,categoryid',
            // 'manufacturerid' => 'exists:kimiagar_manufacturers,manufacturerid',
        ]);
        // return $request->all();
        if ($request->imageUrl != 'undefined') {
            $request->validate([
                'imageUrl' => 'sometimes|image|max:300|mimes:jpeg,jpg,png',
            ]);
        }
        // $manufactorer = Manufactory::where('user_login', auth()->user()->login)->first();
        $product = Product::where('id', $request->id)->first();

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('panel.admin.product.edit', ['slug' => $product->slug]),
                'redirectList' => route('panel.admin.products'),
            ];
        }
        
        $product->name = $request->name;
        $product->code = $request->code;
        $product->save();

        if ($request->categories[0]) {
            $product->categories()->sync($request->categories);
        }

        if ($request->imageUrl != 'undefined') {

            $date = date('Y-m-d');
            $path = "uploads/products/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);

            $iconOld = Image::where('imageable_id', $product->id)
                ->where('imageable_type', 'App\Models\Product')
                // ->where('type', 'MAIN')
                ->where('default_use', 'MAIN')
                ->first();
            if($iconOld){
                UploadService::destroyFile($iconOld->path);
                $iconOld = Image::where('imageable_id', $product->id)
                ->where('imageable_type', 'App\Models\Product')
                // ->where('type', 'MAIN')
                ->where('default_use', 'MAIN')
                ->delete();
            }
            $image = Image::updateOrCreate(
                [
                    'imageable_id' => $product->id,
                    'type' => 'MAIN', 
                    'default_use' => 'MAIN',
                    'imageable_type' => 'App\Models\Product', 
                ],
                [
                    'path' => $photos, 
                    'imageable_id' => $product->id, 
                    'active' => '1', 
                ]
            );
        ///////////////////////////
        }
        $redirectAuto = '';
        if ($request->categories[0]) {
            $redirectAuto = route('panel.admin.product.edit', ['slug' => $product->slug]);
        }

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.admin.product.edit', ['slug' => $product->slug]),
            'redirectList' => route('panel.admin.products'),
            'redirectAuto' => $redirectAuto,
        ];
    }

    public function editProductStep2(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'file' => ['required', 'image', 'max:300'],
        ]);

        $date = date('Y-m-d');
        $path = "uploads/products/$request->productid/gallery/$date";
        $photos = [$request->file];
        $photos = UploadService::saveFile($path, $photos);

        $image = Image::create(
            [
                'imageable_id' => $request->id,
                // 'type' => 'MAIN', 
                'default_use' => 'GALLERY',
                'imageable_type' => 'App\Models\Product', 
                'path' => $photos, 
                'active' => '1', 
            ]
        );

        //C:\wamp64\www\chabahar\resources\views\Admin\components\image-gallery-private-tour.blade.php
        return [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => (string) view('admin.components.image-gallery-product', ['image' => $image]),//imageUpload
            // 'redirectEdit' => route('places.edit', ['id' => $place->id]),
            'redirectList' => route('panel.admin.products'),
        ];
    }

    public function editProductStep2Delete(Request $request, $id)
    {
        //
        $image = Image::where('id', $id)->first();

        UploadService::destroyFile($image->path);

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
            'id' => 'required|exists:products,id',
        ]);

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('panel.admin.product.edit', ['slug' => $product->slug]),
                'redirectList' => route('panel.admin.products'),
            ];
        }
        $product = Product::where('id', $request->id)->first();

        $product->description_short = $request->description_short;
        $product->description_full = $request->description_full;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;
        $product->save();

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',
            'redirectList' => route('panel.admin.products'),
        ];
    }

    public function editProductStep4(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $product = Product::where('id', $request->id)->first();

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('panel.admin.product.edit', ['slug' => $product->slug]),
                'redirectList' => route('panel.admin.products'),
            ];
        }
        
        ExtraFieldsProduct::where('product_id', $request->id)->delete();
        foreach ($request->extra_filed as $key => $value) {
            ExtraFieldsProduct::insert([
                'product_id' => $request->id,
                'extra_field_id' => $key,
                'value' => $value,
            ]);
        }

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => $request->productid . '',
            'redirectEdit' => '',
            'redirectList' => route('panel.admin.products'),
        ];
    }

    public function editProductStep5(Request $request)
    {
        # code...
        $request->validate([
            'id' => 'required|exists:products,id',
            'price' => 'required|numeric',
            'count' => 'required|numeric',
            'tax' => 'required|numeric',
            'discount' => 'sometimes|numeric'
        ]);

        $product = Product::where('id', $request->id)->first();

        if (!Auth::check()) {
            return [
                'title' => '',
                'message' => 'شما اجازه ویرایش این محصول را ندارید.',
                'status' => 'error',
                'data' => '',
                'redirectEdit' => route('panel.admin.product.edit', ['slug' => $product->slug]),
                'redirectList' => route('panel.admin.products'),
            ];
        }

        $price = Price::where('id', $request->price_id)->first();
        if(!$price){
            $price = new Price();
        }
        $price->seller_id = 0;
        $price->user_id = auth()->user()->id;
        $price->product_id = $request->id;
        $price->price = $request->price;
        $price->count = $request->count;
        $price->unit = $request->unit;
        $price->tax = $request->tax;
        $price->discount = $request->discount;
        $price->type_discount = $request->type_discount;
        $price->start_discount_at = $request->start_discount_at;
        $price->end_discount_at = $request->end_discount_at;
        $price->save();

        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => $request->productid . '',
            'redirectEdit' => '',
            'redirectList' => route('panel.admin.products'),
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
        $product = Product::where('id', $id)->delete();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return back()->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }
}
