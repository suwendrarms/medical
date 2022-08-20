<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\drug;

class DrugController extends Controller
{
    public function index()
    {
        $drugs = DB::table('drugs as p')->get();
        return view('pages.drug_mgt.index',compact('drugs'));
        
    }

    public function save(Request $request)
    {
        $data= drug::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'status'=>1
        ]);

        return redirect()->route('drug.index')->with('status', 'Image Uploaded Successfully');
        
    }

    public function changeStatus(Request $request){

        $drug=drug::where('id',$request->id)->update([
                   
            'status' => $request->status,
            
        ]);

        return 'success';

    }
}
