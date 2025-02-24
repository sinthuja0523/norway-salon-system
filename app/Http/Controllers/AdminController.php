<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use DB;

class AdminController extends Controller
{
    public function newAppointmentsView(){

        $bookings = DB::table('bookings')->where('status','pending')->get();

        return view('admin.pages.new-appointments',compact('bookings'));
    }
    public function rejectedAppointmentsView ()
    {
        $bookings = DB::table('bookings')->where('status','rejected')->get();
        return view('admin.pages.rejected-appointments',compact('bookings'));
    }
    public function pastappointmentView()
    {
        $bookings = DB::table('bookings')->get();
        return view('admin.pages.past-appointments',compact('bookings'));

    }

    public function timeSlotsView()
    {
        $bookings = DB::table('timeslots')->get();
        return view('admin.pages.time-slots' , compact('bookings'));
    }
    public function dailyReportsView()
    {
        $bookings = DB::table('bookings')->get();
        return view('admin.pages.dailyReports' , compact('bookings'));

    }
    public function weeklyReportsView()
    {
        $bookings = DB::table('bookings')->get();
        return view('admin.pages.weekly-reports' , compact('bookings'));

    }
    public function monthlyReportsView()
    {
        $bookings = DB::table('bookings')->get();
        return view('admin.pages.monthly-reports' , compact('bookings'));
    }
    public function branchesView()
    {
        $bookings = DB::table('branches')->get();
        return view('admin.pages.branches' , compact('bookings'));

    }

    public function approvedAppointmentsView(){
        $bookings = DB::table('bookings')->where('status','approved')->get();
        return view('admin.pages.approved-appointments',compact('bookings'));
    }
    public function approveAppointment(Request $request){
        // \Log::info($request->all());
        $data = Booking::find($request->appointment_id);
        $data->status = "approved";
        $data->save();

        return response()->json(['success'=>true]);
    }

    public function declineAppointment(Request $request){
        \Log::info($request->all());
        $data = Booking::find($request->appointment_id);
        $data->status = "rejected";
        $data->save();

        return response()->json(['success'=>true]);
    }



}

