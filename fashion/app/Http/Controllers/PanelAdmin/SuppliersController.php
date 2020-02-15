<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manufactory;
use App\Models\Category;
use App\User;

class SuppliersController extends Controller
{
    //
    public function suppliers(Request $request)
    {
        $title = ($request->title) ? $request->title : null;
        # code...
        $factories = Manufactory::latest('manufacturerid')->when($title, function($query) use($title){ $query->where('manufacturer', 'like', "%$title%"); })->get();

        // return $factories;
        
        return view('admin.pages-admin.list-factories', [
            'factories'    => $factories,
            'title'    => 'لیست تولید کنندگان',
        ]);
    }

    public function manufactorUpdateOrInsert(Request $request, $manufacturerid = null)
    {
        # code...
        
        // $factory_info = "";//file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$page_filename."info.html") ;// "factories";
        // $factory_specification = "";//file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$page_filename."specification.html") ;//"FOOTER";
        // $factory_transportation = "";//file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$page->filename."transportation.html") ;//null;
        // $routeAction = route("panel.adminer.manufactor.updateOrInsert.post");
        
        $factory = Manufactory::where('manufacturerid', $manufacturerid)->first();

        if($factory){
            $factory->info_file = @file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$factory->manufacturer_en."/info.html") ;// "factories";
            $factory->specification_file = @file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$factory->manufacturer_en."/specification.html") ;//"FOOTER";
            $factory->transportation_file = @file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$factory->manufacturer_en."/transportation.html") ;//null;
            $factory->routeAction = route("panel.adminer.manufactor.updateOrInsert.post", [ 'manufacturerid' => $factory->manufacturerid ]);
        }
        // return $factory;


        if(!$factory){
            $factory = new \stdClass();
            $factory->manufacturerid = null;
            $factory->manufacturer = "";
            $factory->manufacturer_en = "";
            $factory->avail = "Y";
            $factory->orderby = "1";
            $factory->user_login = null;
            $factory->category_id = null;
            
            $factory->info_file = "";//file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$page_filename."info.html") ;// "factories";
            $factory->specification_file = "";//file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$page_filename."specification.html") ;//"FOOTER";
            $factory->transportation_file = "";//file_get_contents("http://cerampakhsh.com/skin1/pages/factories/".$page->filename."transportation.html") ;//null;
            $factory->routeAction = route("panel.adminer.manufactor.updateOrInsert.post");
        }

        $categories = Category::where([['parentid', 0],['avail', 'Y'],['is_menu', 'Y']])
            ->select('category','categoryid','parentid')
            ->with(['children'=> function($query){
                $query->where([['parentid', 0],['avail', 'Y'],['is_menu', 'Y']])->select('category','categoryid','parentid');
            }])
            ->get();
            
        // return $factory;
        $usersFactory = User::where('role', 3)->get();

        return view('admin.pages-admin.update-ord-insert-factory', [
            'factory'               => $factory,
            'categories'            => $categories,
            'usersFactory'          => $usersFactory,
            'title'                 => 'اضافه / ویرایش کارخانه '. $factory->manufacturer,
        ]);
    }

    
    public function manufactorUpdateOrInsertPost(Request $request, $manufacturerid = null)
    {
        # code...
        // return implode(',',$request->category_id);

        $request->validate([
            'manufacturer' => 'required',
            'manufacturer_en' => 'required',
            // 'avail' => 'required',
            'user_login' => 'required',
            'category_id' => 'required',
        ]);

        $avail = isset($request->avail) ? 'Y' : 'N';

        $factory = null;
        if($manufacturerid){
            $factory = Manufactory::where('manufacturerid', $manufacturerid)->first();
        }
        if(!$factory){
            $factory = new Manufactory();
            $factory->manufacturer_en = $request->manufacturer_en;
        }

        $factory->manufacturer = $request->manufacturer;
        $factory->avail = $avail;
        $factory->user_login = $request->user_login;
        $factory->category_id = implode(',',$request->category_id);

        $factory->save();

        
        $result_1 = $this->callAPI('GET', ['file' => "factories/".$factory->manufacturer_en."/info.html", 'text' => $request->info_file]);
        $result_2 = $this->callAPI('GET', ['file' => "factories/".$factory->manufacturer_en."/specification.html", 'text' => $request->specification_file]);
        $result_3 = $this->callAPI('GET', ['file' => "factories/".$factory->manufacturer_en."/transportation.html", 'text' => $request->transportation_file]);
        // return $result_1;
        if($result_1 != 'success' || $result_2 != 'success' || $result_3 != 'success'){
            return [
                'title' => '',
                'message' => 'دوباره تلاش نمایید',
                'status' => 'error',
                'data1' => $result_1,
                'data2' => $result_2,
                'data3' => $result_3,
            ];
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت ذخیره گردید.',
            'status' => 'success',
            'data' => $result_1,
        ];

        // manufacturer: "کاشی نارین"
        // manufacturer_en: "narin-tile"
        // avail: "Y"
        // user_login: "00989130000001"
        // category_id: ["2139"]
        // 0: "2139"
        // info_file: 
        // specification_file: 
        // transportation_file:
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
