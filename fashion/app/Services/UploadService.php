<?php

namespace App\Services;
use Illuminate\Support\Str;

use Intervention\Image\ImageManagerStatic as Image;

class UploadService
{
    // private $photos_path;
 
    // public function __construct($path)
    // {
    //     $this->photos_path = public_path($path);//'/images'
    // }
 
    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public static function saveFile($path, $photos)
    {

        $pathFull = public_path($path);
        // $photos = $request->file('file');
 
        if (!is_array($photos)) {
            $photos = [$photos];
        }
 
        if (!is_dir($pathFull)) {
            mkdir($pathFull, 0777, true);
        }

        $lists = '';//[];
 
        for ($i = 0; $i < count($photos); $i++) {
            // if( $photos ) {
            //     $path = $photos->getRealPath();
            //     return $path;
            // } else {
            //     return 'back()->withErrors(...)';
            // }
            
            $photo = $photos[$i];
            $name = sha1(date('YmdHis') . Str::random(30));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
 
            $photo->move($pathFull, $save_name);
            // self::resizeImage($photo, $path, 300, 300);
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
            // array_push($lists, $protocol.$_SERVER['HTTP_HOST'].'/'.$path.'/'. $save_name);
            //$protocol.$_SERVER['HTTP_HOST']
            // $lists= self::baseUrl().'/'.$path.'/'. $save_name;
            $lists= $path.'/'. $save_name;
            
        }
        return $lists;

    }
 
    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
    public static function destroyFile($imageUrl)
    {
        $domain = self::baseUrl();

        $path = str_replace($domain, '', 'public/'.$imageUrl);
        // return [$path,$domain];
        if (file_exists( $path)) {
            unlink($path);
        }

        if (file_exists( 'resize/small/'.$path)) {
            unlink('resize/small/'.$path);
        }
        if (file_exists( 'resize/medium/'.$path)) {
            unlink('resize/medium/'.$path);
        }
        if (file_exists( 'resize/big/'.$path)) {
            unlink('resize/big/'.$path);
        }


    }

    public static function resizeImage($image, $path, $width, $height = null)
    {
        

        if($height == null){
            $height = $width;
        }
        // $image=Request()->file('img');

        $pathFull_ = $path . '/'. $width . '-' . $height . '/';
        
        $pathFull = public_path($pathFull_);
        // $photos = $request->file('file');
 
        if (!is_dir($pathFull)) {
            mkdir($pathFull, 0777, true);
        }

        // $image       = $request->file('image');
        $filename    = 'zareie' . '-' . time() . '.' . $image->getClientOriginalName();
    
        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize($width, $height);
        $image_resize->save(public_path($pathFull_ .$filename));

        return public_path($pathFull_ .$filename);

    }

    public static function baseUrl()
    {
        $currentPath = $_SERVER['PHP_SELF'];


        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

        // return: http://localhost/myproject/
        return str_replace('\\','',$protocol.$hostName.$pathInfo['dirname']);
    }

    public static function imageCropPost($path, $photos)
    {
        $data = $photos;// $request->image;

        $pathFull = public_path($path);
        // $photos = $request->file('file');
 
        if (!is_dir($pathFull)) {
            mkdir($pathFull, 0777, true);
        }

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        // $image_name= time().'.png';
        
        $name = sha1(date('YmdHis') . Str::random(30));
        $image_name = $name . '.png';
        $path_ = "$pathFull/" . $image_name;


        file_put_contents($path_, $data);

        return "$path/" . $image_name;

        return response()->json(['success'=>'done']);
    }
}