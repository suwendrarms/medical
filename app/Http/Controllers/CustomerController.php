<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct() {
        
        $this->upload = new UploadController;
        $this->DbManagement= new DbManagementController;
        
    }

    public function index()
    {
        
        $customers = DB::table('users as u')
        ->orderBy('u.created_at','desc')
        ->get();
      
        return view('pages.customer.index',compact('customers'));
    }

    public function change(Request $request){
        $id = $request->id;
        $user = User::where('id',$id)->first();

        if($user){
            $user->user_type =2;
            $user->save();
        }
       
        return 'success';
    }
}
