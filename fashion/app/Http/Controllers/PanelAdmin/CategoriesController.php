<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Icon;
use App\Services\UploadService;
use App\Models\ExtraField;

class CategoriesController extends Controller
{
    //
    public function categories(Request $request, $parentid = 0)
    {
        $category = isset($request->category) ? $request->category : null;
        $categories = Category::whereNotNull('categoryid')
        ->when($category, function($queryCategory) use($category){
            $queryCategory->where(function($query) use($category){
                $query->orWhere('category', 'like', "%$category%")->orWhere('slug', 'like', "%$category%")->orWhere('link', 'like', "%$category%");
            });
        })
        ->where('parentid', $parentid)
        ->orderBy('order_by')
        ->get();
        // return $categories;

        $title = 'لیست دسته بندی ها';
        $category = null;
        if($parentid){
            $category = Category::where('categoryid', $parentid)->first();
            $title = 'لیست دسته بندی های ' .$category->category;
        }

        return view('admin.pages-admin.list-categories', [
            'categories'    => $categories,
            'category'    => $category,
            'parentid'    => $parentid,
            'title'         => $title,
        ]);
    }

    
    public function categoriesUpdate(Request $request)
    {
        // return $request->all();

        foreach ($request->data as $key => $value) {
            # code...
            // echo $key;
            // if(isset($value['check'])){
                $avail = isset($value['avail']) ? 'Y' : 'N';
                $is_menu = isset($value['is_menu']) ? 'Y' : 'N';
                $is_add = isset($value['is_add']) ? 'Y' : 'N';//is_filter
                $is_filter = isset($value['is_filter']) ? 'Y' : 'N';//is_filter

                Category::where('categoryid', $key)->update([
                    'order_by' => $value['order_by'],
                    'avail' => $avail,
                    'is_menu' => $is_menu,
                    'is_add' => $is_add,
                    'is_filter' => $is_filter,
                ]);
            // }
        }
        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'info',
            'data' => '',
        ]);
    }

    public function categoryAdd($parentid = 0)
    {
        
        return view('admin.pages-admin.add-category', [
            'routePost'     => route('panel.adminer.categories.add.post', ['parentid'=> $parentid]),
            'category'      => null,
            'title'         => 'دسته بندی جدید دسته',
        ]);
    }

    public function categoryAddPost(Request $request, $parentid)
    {
        # code...
        // return (isset($request->avail)) ? 'Y' : 'N';
        $request->validate([
            'category'      => 'required|string',
            // 'link'          => 'sometimes|string',
            // 'description'   => 'sometimes|string',
        ]);

        $photos = null;
        if($request->imageUrl != 'undefined'){
            $request->validate([
                'imageUrl' => 'image|max:300|mimes:jpeg,jpg',
            ]);
            $date = date('Y-m-d');
            $path = "uploads/categories/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);
        }

        $category = Category::create([
            'parentid'      => $parentid,
            'category'      => $request->category,
            'link'          => ($request->link) ? $request->link : '',
            'avail'         => (isset($request->avail)) ? 'Y' : 'N',
            'is_menu'       => (isset($request->is_menu)) ? 'Y' : 'N',
            'is_filter'     => (isset($request->is_filter)) ? 'Y' : 'N',
            'is_add'        => (isset($request->is_add)) ? 'Y' : 'N',
            'description'   => ($request->description) ? $request->description : '',
        ]);

        if($photos){
            $icon = Icon::updateOrCreate(
                ['categoryid' => $category->categoryid],
                [
                    'image_path' => $photos,
                    'image_type' => 'image/jpeg'
                ]
            );
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.adminer.category.edit', ['categoryid' => $category->categoryid]),
            'redirectList' => route('panel.adminer.categories', ['parent'=> $parentid]),
        ];
        
    }

    public function categoryEdit(Request $request, $categoryid)
    {
        # code...
        $category = Category::where('categoryid', $categoryid)->with('icon')->first();
        // return $category;
        return view('admin.pages-admin.add-category', [
            'routePost'     => route('panel.adminer.categories.update.categoryid', ['categoryid'=> $categoryid]),
            'category'      => $category,
            'title'         => 'دسته بندی جدید دسته',
        ]);
    }

    public function categoryUpdate(Request $request, $categoryid)
    {
        # code...
        // return (isset($request->avail)) ? 'Y' : 'N';
        $request->validate([
            'category'      => 'required|string',
            // 'link'          => 'sometimes|string',
            // 'description'   => 'sometimes|string',
        ]);

        $photos = null;
        if($request->imageUrl != 'undefined'){
            $request->validate([
                'imageUrl' => 'image|max:300|mimes:jpeg,jpg',
            ]);
            $date = date('Y-m-d');
            $path = "uploads/categories/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);
        }

        $category = Category::where('categoryid',$categoryid);
        
        $category->update([
            // 'parentid'      => $parentid,
            'category'      => $request->category,
            'link'          => ($request->link) ? $request->link : '',
            'avail'         => (isset($request->avail)) ? 'Y' : 'N',
            'is_menu'       => (isset($request->is_menu)) ? 'Y' : 'N',
            'is_filter'     => (isset($request->is_filter)) ? 'Y' : 'N',
            'is_add'        => (isset($request->is_add)) ? 'Y' : 'N',
            'description'   => ($request->description) ? $request->description : '',
        ]);

        if($photos){
            $icon = Icon::updateOrCreate(
                ['categoryid' => $category->categoryid],
                [
                    'image_path' => $photos,
                    'image_type' => 'image/jpeg'
                ]
            );
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.adminer.category.edit', ['categoryid' => $category->first()->categoryid]),
            'redirectList' => route('panel.adminer.categories', ['parent'=> $category->first()->parentid]),
        ];
        
    }
    
    public function categoryDelete(Request $request, $categoryid)
    {
        $category = Category::where('categoryid', $categoryid)->first();

        if(!$category){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.adminer.users')->with('noty', [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $category = Category::where('categoryid', $categoryid)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.users')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }


    public function properties(Request $request, $category_id = null)
    {
        # code...
        $properties = ExtraField::where('category_id', $category_id)->orderBy('orderby')->get();

        if( ( $category_id == 2127 || $category_id == 2169 )){
            $properties = ExtraField::whereNull('category_id')->orWhere('category_id', $category_id)->orderBy('orderby')->get();
        }
        // return $properties;
        return view('admin.pages-admin.list-propertied', [
            'properties'    => $properties,
            'category_id'    => $category_id,
            'title'         => 'لیست پراپرتی های دسته '. $category_id,
        ]);

    }

    public function propertyDelete(Request $request, $fieldid)
    {
        # code...
        $category = ExtraField::where('fieldid', $fieldid)->first();

        if(!$category){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.adminer.users')->with('noty', [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $category = ExtraField::where('fieldid', $fieldid)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.users')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }

    public function propertiesUpdate(Request $request)
    {
        // return $request->all();
        # code...
        foreach ($request->data as $key => $value) {
            # code...
            // echo $key;
            // if(isset($value['check'])){
                $active = isset($value['active']) ? 'Y' : 'N';
                $show_less = isset($value['show_less']) ? 'Y' : 'N';

                ExtraField::where('fieldid', $key)->update([
                    'orderby' => $value['orderby'],
                    'active' => $active,
                    'show_less' => $show_less,
                    'field' => $value['field'],
                    'value' => $value['value'],
                ]);
            // }
        }
        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }

    public function propertiesAdd(Request $request, $categoryid)
    {
        // return $request->all();

        $request->validate([
            'field'      => 'required|string',
            'orderby'      => 'required|numeric',
        ]);

        $active = isset($request->active) ? 'Y' : 'N';
        $show_less = isset($request->show_less) ? 'Y' : 'N';

        ExtraField::create([
            'provider'      => 'master',
            'field'         => $request->field,
            'value'         => ($request->value) ? $request->value : '',
            'active'        => $active,
            'category_id'   => $categoryid,
            'show_less'     => $show_less,
            'orderby'       => $request->orderby,
        ]);

        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت اضافه  گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }
}
