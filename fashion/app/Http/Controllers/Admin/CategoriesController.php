<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Services\UploadService;
use App\Models\ExtraField;

class CategoriesController extends Controller
{
    //
    public function categories(Request $request, $parent_id = 0)
    {
        $category = isset($request->category) ? $request->category : null;
        $categories = Category::whereNotNull('id')
        ->when($category, function($queryCategory) use($category){
            $queryCategory->where(function($query) use($category){
                $query->orWhere('name', 'like', "%$category%")->orWhere('slug', 'like', "%$category%")->orWhere('link', 'like', "%$category%");
            });
        })
        ->where('parent_id', $parent_id)
        ->orderBy('order')
        ->get();
        // return $categories;

        $title = 'لیست دسته بندی ها';
        $category = null;
        if($parent_id){
            $category = Category::where('id', $parent_id)->first();
            $title = 'زیر دسته های ' .$category->name;
        }

        return view('admin.pages-admin.list-categories', [
            'categories'    => $categories,
            'category'    => $category,
            'parent_id'    => $parent_id,
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
                $active = isset($value['active']) ? '1' : '0';
                $menu = isset($value['menu']) ? '1' : '0';
                $add_product = isset($value['add_product']) ? '1' : '0';//is_filter
                $filter = isset($value['filter']) ? '1' : '0';//is_filter

                Category::where('id', $key)->update([
                    'order' => $value['order'],
                    'active' => $active,
                    'menu' => $menu,
                    'add_product' => $add_product,
                    'filter' => $filter,
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
            'routePost'     => route('panel.admin.categories.add.post', ['parentid'=> $parentid]),
            'category'      => null,
            'title'         => 'دسته بندی جدید دسته',
        ]);
    }

    public function categoryAddPost(Request $request, $parent_id)
    {
        $request->validate([
            'name'      => 'required|string',
        ]);

        $photos = null;
        if($request->imageUrl != 'undefined'){
            $request->validate([
                'imageUrl' => 'image|max:300|mimes:jpeg,jpg,png',
            ]);
            $date = date('Y-m-d');
            $path = "uploads/categories/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);
        }

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $parent_id,
            'icon' => '',// $request->icon,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'title_page' => $request->title_page,
            'link' => $request->link,
            'order' => 0,
            'menu' => (isset($request->menu)) ? '1' : '0',
            'filter' => (isset($request->filter)) ? '1' : '0',
            'add_product' => (isset($request->add_product)) ? '1' : '0',
            'active' => (isset($request->active)) ? '1' : '0',
            'default_message' => $request->default_message,

        ]);

        if($photos){
            $icon = Image::updateOrCreate(
                ['imageable_id' => $category->id, 'imageable_type' => 'App\Models\Category'],
                [
                    'path' => $photos, 
                    'imageable_type' => 'App\Models\Category', 
                    'imageable_id' => $category->id, 
                    'type' => 'MAIN', 
                    'active' => '1', 
                    'default_use' => 'MAIN',
                ]
            );
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.admin.category.edit', ['id' => $category->id]),
            'redirectList' => route('panel.admin.categories', ['parent'=> $parent_id]),
        ];
        
    }

    public function categoryEdit(Request $request, $id)
    {
        # code...
        $category = Category::where('id', $id)->with(['image'=> function($query){$query->where('default_use','MAIN')->first();}])->first();
        // return count($category->image);
        return view('admin.pages-admin.add-category', [
            'routePost'     => route('panel.admin.categories.update.id', ['id'=> $id]),
            'category'      => $category,
            'title'         => 'دسته بندی ' . $category->name,
        ]);
    }

    public function categoryUpdate(Request $request, $id)
    {
        // return $id;
        $request->validate([
            'name'      => 'required|string',
        ]);

        $photos = null;
        if($request->imageUrl != 'undefined'){
            $request->validate([
                'imageUrl' => 'image|max:300|mimes:jpeg,jpg,png',
            ]);
            $date = date('Y-m-d');
            $path = "uploads/categories/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);
        }

        $category = Category::where('id',$id)->first();
        
        $category->update([
            'name' => $request->name,
            'parent_id' => $category->first()->parent_id,
            'icon' => $request->icon,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'title_page' => $request->title_page,
            'link' => $request->link,
            'order' => 0,
            'menu' => (isset($request->menu)) ? '1' : '0',
            'filter' => (isset($request->filter)) ? '1' : '0',
            'add_product' => (isset($request->add_product)) ? '1' : '0',
            'active' => (isset($request->active)) ? '1' : '0',
            'default_message' => $request->default_message,
        ]);

        
        if($photos){
            $iconOld = Image::where('imageable_id', $category->id)->first();
            if($iconOld){
                UploadService::destroyFile($iconOld->path);
            }
            $icon = Image::updateOrCreate(
                ['imageable_id' => $category->id, 'imageable_type' => 'App\Models\Category'],
                [
                    'path' => $photos, 
                    'imageable_type' => 'App\Models\Category', 
                    'imageable_id' => $category->id, 
                    'type' => 'MAIN', 
                    'active' => '1', 
                    'default_use' => 'MAIN',
                ]
            );
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.admin.category.edit', ['id' => $id]),
            'redirectList' => route('panel.admin.categories', ['parent_id'=> $category->first()->parent_id]),
        ];
        
    }
    
    public function categoryDelete(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();

        if(!$category){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.admin.users')->with('noty', [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $category = Category::where('id', $id)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.admin.users')->with('noty', [
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
        $properties = ExtraField::where('category_id', $category_id)->orderBy('order')->get();

        // return $properties;
        return view('admin.pages-admin.list-propertied', [
            'properties'    => $properties,
            'category_id'    => $category_id,
            'title'         => 'لیست پراپرتی های دسته '. $category_id,
        ]);

    }

    public function propertyDelete(Request $request, $id)
    {
        # code...
        $category = ExtraField::where('id', $id)->first();

        if(!$category){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.admin.users')->with('noty', [
                    'title' => '',
                    'message' => 'دسته بندی وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $category = ExtraField::where('id', $id)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.admin.users')->with('noty', [
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
                $active = isset($value['active']) ? '1' : '0';
                $show_less = isset($value['show_less']) ? '1' : '0';

                ExtraField::where('id', $key)->update([
                    'order' => $value['order'],
                    'active' => $active,
                    'show_less' => $show_less,
                    'name' => $value['name'],
                    'default_list' => $value['default_list'],
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

    public function propertiesAdd(Request $request, $category_id)
    {
        // return $request->all();

        $request->validate([
            'name'      => 'required|string',
            'order'      => 'required|numeric',
        ]);

        $active = isset($request->active) ? '1' : '0';
        $show_less = isset($request->show_less) ? '1' : '0';

        ExtraField::create([
            'name'          => $request->name,
            'default_list'  => ($request->default_list) ? $request->default_list : '',
            'active'        => $active,
            'category_id'   => $category_id,
            'show_less'     => $show_less,
            'order'       => $request->order,
        ]);

        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت اضافه  گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }

    
    public function changeCategories( Request $request)
    {
        // return $request->all();
        # code...
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);
        $categories = Category::orderBy('id')
            ->select('name', 'id')
            ->where('parent_id', $request->id)
            ->where('menu', '1')
            ->where('add_product', '1')
            ->where('active', '1')
            ->get();

        $data = '<option > -- انتخاب دسته بندی --</option>';
        foreach ($categories as $category){

            $data .= '<option value="'.$category->id.'">'.$category->name.'</option>';
        }
        
        return $data;
    }
}
