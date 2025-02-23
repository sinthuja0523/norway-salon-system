<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function TimeSlotsView()
    {

        $bookings = DB::table('timeslots')->get();
        dd($bookings);
        return view('admin.pages.time-slots' , compact('bookings'));
    }
}
