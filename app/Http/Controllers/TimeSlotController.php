<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\drug;
use App\Models\time_slot_date;

class TimeSlotController extends Controller
{
    public function index()
    {
        $times = DB::table('time_slot_dates as p')->get();
        return view('pages.time_mgt.index',compact('times'));
        
    }

    public function save(Request $request)
    {

        $time1 = strtotime($request->start_time);
        $time2 = strtotime($request->end_time);
        $difference = round(abs($time2 - $time1) / 3600,2);

        $day1=date("g:i A", strtotime($request->start_time));
        $day2=date("g:i A", strtotime($request->end_time));

        if($difference ==2){

            $data= time_slot_date::create([
                'date'=>$request->date,
                'start_time'=>$request->start_time, 
                'end_time'=>$request->end_time,
                'slot'=> $day1.' - '. $day2,
                'status'=>1,
            ]);

            return redirect()->route('time.index')->with('msg', 'Time slot create successfully');

        }else{
            return redirect()->route('time.index')->with('status', 'Please give two hour time slot');
        }
        
    }

    public function changeStatus(Request $request){

        $drug=time_slot_date::where('id',$request->id)->update([
                   
            'status' => $request->status,
            
        ]);

        return 'success';

    }

    public function findTimeSlot(Request $request){

        $drug=time_slot_date::where('date',$request->date)->where('status',1)->get();

        //return response()->json( $drug);
        $data=['accept'=>$drug];
 
         return   $data;

    }
}
