<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\customer_vehicle;
use App\notification;
use App\user_app;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct() {
        
        $this->BookingStore = new DbManagementController;
        
    }

    public function index()
    {
        
        $customers = DB::table('users as u')
        ->where('status',1)
        ->orderBy('u.created_at','desc')
        ->get();
      
        return view('pages.customer.index',compact('customers'));
    }

    public function removeCustomer(Request $request){
        //dd($request->all());
        $cus=user_app::where('id',$request->id)->update([            
            'admin_remove'=>1,
            'change_user_id'=>Auth::user()->id,               
        ]);

        $this->BookingStore->notificationStatus($request->id,'new_user_register');

        return 'success';

    }

    public function updateErp(Request $request){
        $id = $request->id;
       
        $user = user_app::where('id',$id)->first();
        if($user){
            $user->customer_erp_id =$request->erp;
            $user->register_status=2;
            $user->save();
        }

        if($request->have_num){

            foreach($request->addShowroomSupervisors as $vh){
                $number=$vh['vehi_name'];
                $this->addCustomerVehicle($id,$number);
            }
        }

        $this->BookingStore->notificationStatus($id,'new_user_register');
       
        return redirect()->back();
    }

    public function addCustomerVehicle($id,$number){
        $vhi= new customer_vehicle;

        $vhi->customer_id=$id;
        $vhi->vehicle_no=$number;
        $vhi->verify_status=true;
        $vhi->save();
    }

    public function vehicle(){
        $customers = DB::table('user_apps as u')
        ->where('device_id','!=',null)
        ->get();

        $vehicle= customer_vehicle::select('id','vehicle_no','customer_id')->where('active_status',null)->where('verify_status',false)->get();
      
        foreach($vehicle as $val){
            $user=user_app::where('id',$val->customer_id)->first();
            $val->customer_name= $user->name;
            $val->phone=$user->phone_number;
        }

        //dd($vehicle);

        return view('pages.customer.vehicle',compact('vehicle'));
    }

    public function showVehicle($id){
        //dd($id);
        $user = user_app::where('id',$id)->first();

        $vehicles= customer_vehicle::where('customer_id',$id)->select('id','vehicle_no','verify_status')->get();

        return view('pages.customer.show_vehicle',compact('vehicles','user'));
    }

    public function activeVehicle(Request $request){

        $book=customer_vehicle::where('id',$request->id)->update([            
            'verify_status'=>true,               
        ]);

        $this->BookingStore->notificationStatus($request->id,'vehicle_update');

        // $data=notification::where('type_id',$request->id)->where('type','vehicle_update')->first();

        // if($data!=null){
        //     // $noti=notification::where('type_id',$request->id)->update([                  
        //     //     'success' => true,               
        //     // ]);
        //     //$data->success=true;
        //     $data->delete();
        // }

        return 'success';
    }

    public function erpEdit(Request $request){
       // dd($request->all());
        $book=user_app::where('id',$request->u_id)->update([            
            'customer_erp_id'=>$request->erp_id,
            'change_user_id'=>Auth::user()->id,               
        ]);

        return redirect()->route('customer.index');
    }

    public function removeVhicle(Request $request){
        $book=customer_vehicle::where('id',$request->id)->update([            
            'active_status'=>1,
            'delete_user_id'=>Auth::user()->id,               
        ]);
        $this->BookingStore->notificationStatus($request->id,'vehicle_update');

        //return redirect()->back();
        return 'success';

    }

    public function vehicleEdit(Request $request){
        //dd($request->all());
        $book=customer_vehicle::where('id',$request->cus_id)->update([            
            'vehicle_no'=>$request->ve_id,             
        ]);

        return redirect()->route('customer.vehicle');
    }
}
