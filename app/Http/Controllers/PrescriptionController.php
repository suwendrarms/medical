<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Controllers\UploadController;
use App\Models\prescription;
use App\Models\prescription_image;
use Illuminate\Support\Facades\Auth;
use App\Models\drug;
use App\Models\time_slot_date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cloudinary;

class PrescriptionController extends Controller
{
    public function __construct() {
        
        $this->upload = new UploadController;
        $this->DbManagement= new DbManagementController;
        
    }

    public function index()
    {

        $prescriptions=$this->DbManagement->getPrescriptions();

        return view('pages.prescriptions.index',compact('prescriptions'));
        
    }

    public function cusindex()
    {

        $prescriptions=$this->DbManagement->getPrescriptionsByUserId(Auth::user()->id);

        return view('pages.prescriptions.cusindex',compact('prescriptions'));
        
    }

    public function create()
    {
        $times = DB::table('time_slot_dates as p')->where('status',1)->get();
        return view('pages.prescriptions.create',compact('times'));
        
    }

    public function uploadImages(Request $request)
    {

        $time1 = strtotime($request->start_time);
        $time2 = strtotime($request->end_time);
        $difference = round(abs($time2 - $time1) / 3600,2);

            if(count($request->image)<=5){

                $data= prescription::create([
                    'user_id'=>Auth::user()->id,
                    'note'=>$request->note,
                    'delivery_address_line1'=>$request->address1,
                    'delivery_address_line2'=>$request->address2,
                    'delivery_address_line3'=>$request->address3,
                    'date'=>$request->date,
                    'time-slot'=>$request->time_slot,
                    'status'=>0
                ]);

                foreach($request->image as $image){
                   //dd($image->path());
                    //$image_name = '/images/products/'.time().'_'.rand(1000, 10000).'.'.$image->getClientOriginalExtension();
                   // $image->move(public_path('images/products'), $image_name);
                   $response = cloudinary()->upload($image->path())->getSecurePath();
                   //dd($response);
                    $image_single=prescription_image::create([
                        'prescription_id'=>$data->id,
                        'url'=>$response,
                        'status'=>0
                    ]);
                }
    
                return redirect()->route('prescriptions.cus.index')->with('message', 'Uploaded Successfully');
            }else{
                return redirect()->route('prescriptions.add')->with('message', 'You can upload only five images');
            }

    }

    public function uploadPrescriptionView($id)
    {
        $prescription=$this->DbManagement->getPrescriptionsById($id);
        $drugs = DB::table('drugs as p')->where('status',1)->get();

        $quotations=$this->DbManagement->getQuotationsById($id);
        $quotations1=$this->DbManagement->getQuotationsShowById($id);

        if($quotations1!=null){
            $count=1;
        }
        // elseif($quotations!=null){
        //     $count1=1;
        // }
        else{
            $count=0;
        }

        return view('pages.prescriptions.view',compact('prescription','drugs','quotations','count'));

    }

    public function myPrescriptionView($id)
    {
        $prescription=$this->DbManagement->getPrescriptionsById($id);
        $drugs = DB::table('drugs as p')->where('status',1)->get();

        $quotations=$this->DbManagement->getQuotationsCustomerById($id);

        //dd($drugs);
        return view('pages.prescriptions.view_cus',compact('prescription','drugs','quotations'));

    }



    public function uploadImagess(Request $request)
    {
       // dd($request->image);
       // $this->validate($request,[
       //     'image_name'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
       // ]);

            $image_name = $request->file('image')->getRealPath();
            //dd($image_name );
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "prescriptions",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            dd($image_url);

        return redirect()->back()->with('status', 'Image Uploaded Successfully');
    }

    public function media(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg|max:1048|required',
            ]);


            $image_name = $request->file('avatar')->getRealPath();
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "laravel_tutorial",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

           $public_id = Cloudder::getPublicId();

            $width = 250;
            $height = 250;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            //In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            if ($public_id != null) {
                $image_public_id_exist = User::select('public_id')->where('id', Auth::user()->id)->get();
                Cloudder::delete($image_public_id_exist);
            }

            $user = User::find(Auth::user()->id);
            $user->public_id = $public_id;
            $user->avatar_url = $image_url;
            $user->update();
            return back()->with('success_msg', 'Media successfully updated!');
        } else {
            return view('media');
        }
    }
}
