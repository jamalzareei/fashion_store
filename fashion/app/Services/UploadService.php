<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;
// use Intervention\Image\ImageManagerStatic as Image;
use  Image;
// use Intervention\Image\ImageManager as Image;

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
        $path = '../../httpdocs/files/' . $path;
        $path_save = $path;
        $pathFull = public_path($path);
        // $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($pathFull)) {
            mkdir($pathFull, 0777, true);
        }

        $lists = ''; //[];

        for ($i = 0; $i < count($photos); $i++) {
            // if( $photos ) {
            //     $path = $photos->getRealPath();
            //     return $path;
            // } else {
            //     return 'back()->withErrors(...)';
            // }

            $photo = $photos[$i];

            $image_info = getimagesize($photo);
            $image_width = $image_info[0];
            $image_height = $image_info[1];

            $name = sha1(date('YmdHis') . Str::random(40));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            // echo $path; return;
            self::resizeImage($photo, str_replace('../../httpdocs/','../../httpdocs/resize/big/',$path), $save_name, 1000, ($image_height * 1000) / $image_width);
            if($image_width == $image_height){
                self::resizeImage($photo, str_replace('../../httpdocs/','../../httpdocs/resize/medium/',$path), $save_name, 420, ($image_height * 420) / $image_width);
            }else{
                self::resizeImage($photo, str_replace('../../httpdocs/','../../httpdocs/resize/medium/',$path), $save_name, 465, ($image_height * 465) / $image_width);
            }
            self::resizeImage($photo, str_replace('../../httpdocs/','../../httpdocs/resize/small/',$path), $save_name, 230, ($image_height * 230) / $image_width);
            

            $photo->move($pathFull, $save_name);



            // self::resizeImage($photo, $path, 300, 300);
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
            // array_push($lists, $protocol.$_SERVER['HTTP_HOST'].'/'.$path.'/'. $save_name);
            //$protocol.$_SERVER['HTTP_HOST']

            
            // $lists= self::baseUrl().'/'.$path.'/'. $save_name;
            $path = str_replace('../../httpdocs/', '', $path);
            
            // $resizepath = "$pathFull/$save_name";
            // self::uploadImageWithCopies(str_replace('../../httpdocs/','../../httpdocs/resize/big/',$resizepath), "$pathFull/$save_name", $save_name, '420');
            
            // self::resizeFinal($resizepath,str_replace('../../httpdocs/','../../httpdocs/resize/big/',$resizepath), 420, 420);
            // $request->file('photo')->getRealPath()

            $lists = $path . '/' . $save_name;
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
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        // array_push($lists, $protocol.$_SERVER['HTTP_HOST'].'/'.$path.'/'. $save_name);
        $domain = $protocol . $_SERVER['HTTP_HOST'];

        $domain = self::baseUrl();

        $path = str_replace($domain, public_path(), $imageUrl);
        if (file_exists($path)) {
            unlink($path);
        }

        // if (file_exists($path)) {
        //     unlink($path);
        //     Storage::delete('250/'.$path);
        // }
    }

    public static function resizeImage($image, $path, $save_name, $width, $height = null)
    {


        if ($height == null) {
            $height = $width;
        }
        // $image=Request()->file('img');

        $pathFull_ = $path . '/';

        $pathFull = public_path($pathFull_);
        // $photos = $request->file('file');

        if (!is_dir($pathFull)) {
            mkdir($pathFull, 0777, true);
        }

        // $image       = $request->file('image');
        $filename    = $save_name;//'zareie' . '-' . time() . '.' . $image->getClientOriginalName();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize($width, $height);
        $image_resize->save(public_path($pathFull_ . $filename));

        return public_path($pathFull_ . $filename);
    }

    public static function baseUrl()
    {
        $currentPath = $_SERVER['PHP_SELF'];


        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';

        // return: http://localhost/myproject/
        return str_replace('\\', '', $protocol . $hostName . $pathInfo['dirname']);
    }

    public static function uploadImageWithCopies($path = null, $uploaded_file = null, $file_name = null, $custom_sizes = null)
    {
        try {
            $imginfo_array  = getimagesize($uploaded_file);

            $mime_type  = $imginfo_array['mime'];

            if ($mime_type == "image/jpeg") {
                $src = imagecreatefromjpeg($uploaded_file);
            } else if ($mime_type == "image/png") {
                $src = imagecreatefrompng($uploaded_file);
            } else if ($mime_type == "image/gif") {
                $src = imagecreatefromgif($uploaded_file);
            } else {
                // throw new Exception("Invalid Image");
                return false;
            }
            //1 
            $inc = 0;
            $newwidth   = array();
            $newheight  = array();
            $tmp    = array();
            $location = array();
            foreach ($custom_sizes as $cS) {

                list($width, $height)  = getimagesize($uploaded_file);
                $newwidth[$inc]       = $cS['width'];
                $newheight[$inc]      = ($height / $width) * $newwidth[$inc];
                $tmp[$inc]          = imagecreatetruecolor($newwidth[$inc], $newheight[$inc]);
                imagecopyresampled($tmp[$inc], $src, 0, 0, 0, 0, $newwidth[$inc], $newheight[$inc], $width, $height);
                $location[$inc] = $path . $cS['prefixStr'] . $file_name;

                $inc++;
            }
            $inc = 0;
            foreach ($custom_sizes as $cS) {
                if ($mime_type == "image/jpeg") {
                    if (imagejpeg($tmp[$inc], $location[$inc], 100)) { } else {
                        return false;
                    }
                } else if ($mime_type == "image/png") {
                    if (imagepng($tmp[$inc], $location[$inc], 9)) { } else {
                        return false;
                    }
                } else if ($mime_type == "image/gif") {
                    if (imagegif($tmp[$inc], $location[$inc], 9)) { } else {
                        return false;
                    }
                } else {
                    //   throw new Exception("Invalid Image");
                    return false;
                }
                $inc++;
            }
            $inc = 0;
            foreach ($custom_sizes as $cS) {
                imagedestroy($tmp[$inc]);
                $inc++;
            }
        } catch (Exception $e) {
            return false;
        }
    }


    function resizeImage_2($imagePath, $width, $height, $filterType, $blur, $bestFit, $cropZoom) {
        //The blur factor where &gt; 1 is blurry, &lt; 1 is sharp.
        $imagick = new \Imagick(realpath($imagePath));
    
        $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);
    
        $cropWidth = $imagick->getImageWidth();
        $cropHeight = $imagick->getImageHeight();
    
        if ($cropZoom) {
            $newWidth = $cropWidth / 2;
            $newHeight = $cropHeight / 2;
    
            $imagick->cropimage(
                $newWidth,
                $newHeight,
                ($cropWidth - $newWidth) / 2,
                ($cropHeight - $newHeight) / 2
            );
    
            $imagick->scaleimage(
                $imagick->getImageWidth() * 4,
                $imagick->getImageHeight() * 4
            );
        }
    
    
        header("Content-Type: image/jpg");
        echo $imagick->getImageBlob();
    }

    public static function resizeFinal($path, $path_save, $width, $height){

        // ../../httpdocs/resize/big/files/uploads/suppliers/2019-12-09/197f0692d7f104d561af1db926c5090272e737f1.jpg
        // ../../httpdocs/resize/big/uploads/suppliers/2019-12-09/197f0692d7f104d561af1db926c5090272e737f1.jpg
        // echo $path.'<br>';echo $path_save;return;
        $filename = $path;
        $percent = 0.5;

        // Content type
        header('Content-Type: image/jpeg');

        // Get new sizes
        list($width, $height) = getimagesize($filename);
        $newwidth = $width * $percent;
        $newheight = $height * $percent;

        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);
        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // copy(str_replace('../../','',$filename),$path_save);
        // Output
        // imagejpeg($thumb);
    }

    
    public static function resizeFinal_2($path, $path_save, $width, $height){
        $filename = $path;
        $percent = 0.5;

        // Content type
        header('Content-Type: image/jpeg');

        // Get new dimensions
        list($width, $height) = getimagesize($filename);
        $new_width = $width * $percent;
        $new_height = $height * $percent;

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Output
        // imagejpeg($image_p, null, 100);
    }
}
