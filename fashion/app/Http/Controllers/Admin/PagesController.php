<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\UploadService;
use DB;

class PagesController extends Controller
{
    //
    public function pages(Request $request)
    {
        $title = ($request->title) ? $request->title : null;
        # code...
        $pages = Page::orderby('order')
        ->when($title, function($query) use($title){ $query->where('title', 'like', "%$title%"); })
        ->get();

        // return $pages;

        return view('admin.pages-admin.list-pages', [
            'pages'    => $pages,
            'title'    => 'لیست صفحات ایستا',
        ]);
    }

    public function pagesUpdate(Request $request)
    {
        // return $request->all();

        foreach ($request->data as $key => $value) {
            # code...
            $active = isset($value['active']) ? '1' : '0';

            if($value['name']){
                Page::where('id', $key)->update([
                    'name' => $value['name'],
                    // 'level' => $value['level'],
                    'order' => $value['order'],
                    'active' => $active,
                    // 'language' => 'IR',
                    'position' => $value['position'],
                ]);
            }
        }
        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }

    public function pageEdit(Request $request, $id)
    {
        # code...
        $page = Page::where('id', $id)->first();
        
        return view('admin.pages-admin.add-page', [
            'page'    => $page,
            'title'    => ' ویرایش '. $page->title,
            'description'    => @file_get_contents("http://cerampakhsh.com/skin1/pages/IR/".$page->name_en),
            'routePost' => route('panel.admin.page.update.id', ['id' => $page->id])
        ]);
    }

    public function pageUpdate(Request $request, $id = null)
    {
        // return $request->all();
        $request->validate([
            'name'=> "required",
            'name_en'=> 'required',
            'position'=> "required",
            'order'=> "required",
            // 'fileupload'=> 'required',
        ]);

        $active = isset($request->active) ? '1' : '0';
        // return $active;

        $page = Page::where('id',  $id)->update([
            'name_en' => $request->name_en.'.html', 
            'name' => $request->name, 
            // 'level' => 'E', 
            'order' => $request->order, 
            'active' => $active, 
            // 'language' => 'IR', 
            'position' => $request->position, 
            // 'url' => '', 
            'meta_keywords' => $request->meta_keywords, 
            'meta_description' => $request->meta_description
        ]);

        if($request->fileupload && $request->fileupload != 'undefined'){
            $path = "IR";
            $photos = [$request->fileupload];
            $photos = UploadService::saveFileHtml($path, $photos , $request->name_en);
            if(!$photos){
                return [
                    'title' => '',
                    'message' => 'دوباره تلاش نمایید',
                    'status' => 'error',
                    'data' => $result,
                ];
            }
        }

        // $result = $this->callAPI('GET', ['file' => 'IR/'.$request->name_en.'.html', 'text' => $request->description]);

        

        return [
            'title' => '',
            'message' => 'با موفقیت ذخیره گردید.',
            'status' => 'success',
            'data' => '',
        ];

    }

    public function pageAdd(Request $request)
    {

        $statement = DB::select("SHOW TABLE STATUS LIKE 'pages'");
        $nextId = $statement[0]->Auto_increment;

        $page = new \stdClass();
        $page->name_en = 'zareie-'.($nextId);
        // var_dump($page->name_en);return;
        // return Page::latest('id')->first();
        $page->name = "";
        $page->order = 1;
        $page->active = "1";
        // $page->language = "IR";
        $page->position = "FOOTER";
        $page->url = null;
        $page->meta_keywords = null;
        $page->meta_description = null;
        
        return view('admin.pages-admin.add-page', [
            'page'    => $page,
            'title'    => 'افزودن صفحه ایستا',
            'description'    => '',
            'routePost' => route('panel.admin.page.add.post')
        ]);
    }

    public function pageAddPost(Request $request)
    {
        # code...
        // return $request->all();

        $request->validate([
            'name'=> "required",
            'name_en'=> 'required',
            'position'=> "required",
            'order'=> "required",
            // 'description'=> 'required',
        ]);


        $active = isset($request->active) ? '1' : '0';
        // return $active;

        $page = Page::create([
            'name_en' => $request->name_en.'.html', 
            'name' => $request->name, 
            'title' => $request->name, 
            // 'level' => 'E', 
            'order' => $request->order, 
            'active' => $active, 
            // 'language' => 'IR', 
            'position' => $request->position, 
            // 'url' => '', 
            'meta_keywords' => $request->meta_keywords, 
            'meta_description' => $request->meta_description
        ]);

        // $result = $this->callAPI('GET', ['file' => 'IR/'.$request->name_en.'.html', 'text' => $request->description]);
        if($request->fileupload && $request->fileupload != 'undefined'){
            $path = "uploads/pages";
            $photos = [$request->fileupload];
            $photos = UploadService::saveFileHtml($path, $photos , $request->name_en);
        }
        
        
        return [
            'title' => '',
            'message' => 'با موفقیت ذخیره گردید.',
            'status' => 'success',
            'data' => '',
        ];
    }

    public function pageDelete(Request $request, $id)
    {
        # code...
        $page = Page::where('id', $id)->first();

        if(!$page){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'پیج وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.admin.pages')->with('noty', [
                    'title' => '',
                    'message' => 'پیج وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $page = Page::where('id', $id)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.admin.pages')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }
    
    public function callAPI($method, $data)
    {
        $url = "https://cerampakhsh.com/skin1/pages/file.php";
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }

                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }

                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }

        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {die("Connection Failure");}
        curl_close($curl);
        return $result;
    }
}
