<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use DB;

class PagesController extends Controller
{
    //
    public function pages(Request $request)
    {
        $title = ($request->title) ? $request->title : null;
        # code...
        $pages = Page::orderBy('orderby')->when($title, function($query) use($title){ $query->where('title', 'like', "%$title%"); })->get();

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
            $active = isset($value['active']) ? 'Y' : 'N';

            if($value['title']){
                Page::where('pageid', $key)->update([
                    'title' => $value['title'],
                    'level' => $value['level'],
                    'orderby' => $value['orderby'],
                    'active' => $active,
                    'language' => 'IR',
                    'place' => $value['place'],
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

    public function pageEdit(Request $request, $pageid)
    {
        # code...
        $page = Page::where('pageid', $pageid)->first();
        
        return view('admin.pages-admin.add-page', [
            'page'    => $page,
            'title'    => ' ویرایش '. $page->title,
            'description'    => file_get_contents("http://cerampakhsh.com/skin1/pages/IR/".$page->filename),
            'routePost' => route('panel.adminer.page.update.pageid', ['pageid' => $page->pageid])
        ]);
    }

    public function pageUpdate(Request $request, $pageid = null)
    {
        // return $request->all();
        $request->validate([
            'title'=> "required",
            'filename'=> 'required',
            'place'=> "required",
            'orderby'=> "required",
            'description'=> 'required',
        ]);

        $active = isset($request->active) ? 'Y' : 'N';
        // return $active;

        $page = Page::where('pageid',  $pageid)->update([
            'filename' => $request->filename.'.html', 
            'title' => $request->title, 
            'level' => 'E', 
            'orderby' => $request->orderby, 
            'active' => $active, 
            'language' => 'IR', 
            'place' => $request->place, 
            'url' => '', 
            'meta_keywords' => $request->meta_keywords, 
            'meta_desciption' => $request->meta_desciption
        ]);

        $result = $this->callAPI('GET', ['file' => 'IR/'.$request->filename.'.html', 'text' => $request->description]);

        if($result != 'success'){
            return [
                'title' => '',
                'message' => 'دوباره تلاش نمایید',
                'status' => 'error',
                'data' => $result,
            ];
        }

        return [
            'title' => '',
            'message' => 'با موفقیت ذخیره گردید.',
            'status' => 'success',
            'data' => $result,
        ];

    }

    public function pageAdd(Request $request)
    {

        $statement = DB::select("SHOW TABLE STATUS LIKE 'kimiagar_pages'");
        $nextId = $statement[0]->Auto_increment;

        $page = new \stdClass();
        $page->filename = 'cerampakhsh'.($nextId);
        // var_dump($page->filename);return;
        // return Page::latest('pageid')->first();
        $page->title = "";
        $page->level = "E";
        $page->orderby = 1;
        $page->active = "Y";
        $page->language = "IR";
        $page->place = "FOOTER";
        $page->url = null;
        $page->meta_keywords = null;
        $page->meta_desciption = null;
        
        return view('admin.pages-admin.add-page', [
            'page'    => $page,
            'title'    => 'افزودن صفحه ایستا',
            'description'    => '',
            'routePost' => route('panel.adminer.page.add.post')
        ]);
    }

    public function pageAddPost(Request $request)
    {
        # code...
        // return $request->all();

        $request->validate([
            'title'=> "required",
            'filename'=> 'required',
            'place'=> "required",
            'orderby'=> "required",
            'description'=> 'required',
        ]);


        $active = isset($request->active) ? 'Y' : 'N';
        // return $active;

        $page = Page::create([
            'filename' => $request->filename.'.html', 
            'title' => $request->title, 
            'level' => 'E', 
            'orderby' => $request->orderby, 
            'active' => $active, 
            'language' => 'IR', 
            'place' => $request->place, 
            'url' => '', 
            'meta_keywords' => $request->meta_keywords, 
            'meta_desciption' => $request->meta_desciption
        ]);

        $result = $this->callAPI('GET', ['file' => 'IR/'.$request->filename.'.html', 'text' => $request->description]);
        if($result != 'success'){
            return [
                'title' => '',
                'message' => 'دوباره تلاش نمایید',
                'status' => 'error',
                'data' => $result,
            ];
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت ذخیره گردید.',
            'status' => 'success',
            'data' => $result,
        ];
    }

    public function pageDelete(Request $request, $pageid)
    {
        # code...
        $page = Page::where('pageid', $pageid)->first();

        if(!$page){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'پیج وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.adminer.pages')->with('noty', [
                    'title' => '',
                    'message' => 'پیج وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $page = Page::where('pageid', $pageid)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.pages')->with('noty', [
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
