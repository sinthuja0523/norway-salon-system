<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TimeSlot;

class TimeSlotController extends Controller
{
    public function index()
    {
        $times = DB::table('time_slots')->get();
        // dd($times);

        return view('admin.pages.time-slots',compact('times'));
    }

    public function storeTime(Request $request)
    {
        // $request->validate([
        //     'service_name' => 'required',
        //     // 'service_description' => 'required',
        //     'service_price' => 'required',
        // ]);

        $time = new TimeSlot();
        $time->time = $request->time_value;
        $time->is_active = 1;
        $time->save();

        return response()->json(['success' => 'Service added successfully!']);
    }

    public function updateTime(Request $request){
        \Log::info('Update rrr service function loaded');
        \Log::info($request->status);

        $time = TimeSlot::find($request->id);
        \Log::info($time);
        $time->is_active = $request->status;
        $time->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function deleleTime($id){
        $data = TimeSlot::find($id);
        $data->delete();
        return response()->json(['message' => 'Time deleted successfully']);
    }
}
