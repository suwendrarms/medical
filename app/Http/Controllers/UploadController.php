<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function setImageUpload($image){

        $year = date('Y');
        $month = date('m');
        $time = time();

            if($image){

                $extension = $image->getClientOriginalExtension();

                $ran = substr(md5(rand()), 0, 10);

                $file_name = $ran.'_'.$time.'.'.$extension;


                $file_path = "uploads/image_test/test/$year/$month/$file_name";
               
                Storage::disk('s3')->put($file_path,File::get($image),'public');
                $path =  Storage::disk('s3')->url($file_path);
              
                $base_response = array("error"=>'0',"message"=>"image_upload_successful", "imagePath"=> $path);

                return $base_response;
            }
    }
}
