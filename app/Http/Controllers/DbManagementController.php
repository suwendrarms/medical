<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\prescription_image;
use App\Models\quotation_row;
use App\Models\notification;

class DbManagementController extends Controller
{
    public function getPrescriptions(){
        $data = DB::table('prescriptions as p')
        ->leftjoin('users as u','u.id','=','p.user_id')
        ->select('p.id as prescription_id','u.id as user_id','p.delivery_address_line1','p.delivery_address_line2','p.delivery_address_line3','p.note','p.time_slot','p.date','p.status as pStatus','u.name','u.email','u.phone_number','u.status as uStatus')
        ->get();

        foreach($data as $val){
           
            $val->images = prescription_image::where('prescription_id',$val->prescription_id)->pluck('url')->all();
       
        }

        return $data;
    }
    
    public function getPrescriptionsByUserId($id){
        $data = DB::table('prescriptions as p')
        ->leftjoin('users as u','u.id','=','p.user_id')
        ->select('p.id as prescription_id','u.id as user_id','p.delivery_address_line1','p.delivery_address_line2','p.delivery_address_line3','p.note','p.time_slot','p.date','p.status as pStatus','u.name','u.email','u.phone_number','u.status as uStatus')
        ->where('user_id',$id)
        ->get();

        foreach($data as $val){
           
            $val->images = prescription_image::where('prescription_id',$val->prescription_id)->pluck('url')->all();
       
        }

        return $data;
    }

    public function getPrescriptionsById($id){
        $data = DB::table('prescriptions as p')
        ->leftjoin('users as u','u.id','=','p.user_id')
        ->select('p.id as prescription_id','u.id as user_id','p.delivery_address_line1','p.delivery_address_line2','p.delivery_address_line3','p.note','p.date','p.time_slot','p.status as pStatus','u.name','u.email','u.phone_number','u.status as uStatus')
        ->where('p.id',$id)
        ->first();

       
           
        $data->images = prescription_image::where('prescription_id',$data->prescription_id)->pluck('url')->all();
       
        return $data;
    }

    public function getQuotationsById($id){
        $data = DB::table('quotations as p')
        ->where('p.prescription_id',$id)
        ->first();

        if($data){
            $data->drugs = quotation_row::where('quotation_id',$data->id)->get();
        }
       
        return $data;
    }

    public function getQuotationsShowById($id){
        $data = DB::table('quotations as p')
        ->where('p.prescription_id',$id)
        ->where('p.status',0)
        ->first();

        if($data){
            $data->drugs = quotation_row::where('quotation_id',$data->id)->get();
        }
       
        return $data;
    }

    public function getQuotationsCustomerById($id){
        $data = DB::table('quotations as p')
        ->where('p.prescription_id',$id)
        ->where('status','!=',0)
        ->first();

        if($data){
            $data->drugs = quotation_row::where('quotation_id',$data->id)->get();
        }
       
        return $data;
    }

    public function notificationStatus($id,$type){
        //notification
        $data=notification::where('type_id',$id)->where('type',$type)->first();
        if($data!=null){
            $data->delete();
        } 
    }

    public function addNotification($id,$type){
        $data= notification::create([
            'type_id'=>$id,
            'type'=>$type,
            'success'=>false,
        ]);
    }
}
