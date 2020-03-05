<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadService;

class FilesController extends Controller
{
    //

    function list(Request $request) {

        $path = './public/uploads';
        $fileList = glob('./public/uploads/*');
        $pathBack =null;
        if($request->path){
            $path = "$request->path";
            $fileList = glob("$request->path/*");
        }
        
        if ($path != './public/uploads') {
            # code...
            $pathBack = substr($path, 0, strrpos($path, '/'));
        }

        // if(!$fileList){
        //     $files = scandir($path, 0);
        //     for($i = 2; $i < count($files); $i++)
        //         print $files[$i]."<br>";

        // }
        
        $listFolders = [];
        $listFiles = [];
        // var_dump(glob('../../cerampakhsh.com/*'));die();
        
        foreach ($fileList as $filename) {
            //Simply print them out onto the screen.
            if(is_file($filename)){
                array_push($listFiles,$filename);
            }else{
                array_push($listFolders,$filename);
            }
        }
        // return $listFiles;

        # code...
        return view('admin.pages-admin.list-files', [
            'listFolders'   => $listFolders,
            'listFiles'     => $listFiles,
            'path'          => str_replace('./public/','',$path),
            'pathBack'      => $pathBack,
            'title'         => 'فایل منیجر',
        ]);
    }

    public function upload(Request $request)
    {
        # code...
        // return $request->all();
        $request->validate([
            // 'productid' => 'required|exists:kimiagar_products,productid',
            'file' => ['required', 'image' ,'max:300'],
        ]);
        
        $date = date('Y-m-d');
        $path = $request->path;
        // return $path;
        $photos = [$request->file];
        $photos = UploadService::saveFile($path, $photos);

        return [
            'title' => '',
            'message' => "$photos",
            'status' => 'success',
            'data' =>  $photos,
            // 'redirectEdit' => route('places.edit', ['id' => $place->id]),
            // 'redirectList' => route('list.product.supplier'),
        ];
    }

    public function delete(Request $request)
    {
        // return $request->path;
        # code...
        unlink($request->path);
        
        return back()->with('noty', [
            'title' => '',
            'message' => 'فایل حذف گردید',
            'status' => 'info',
            'data' => '',
        ]);
    }
}
