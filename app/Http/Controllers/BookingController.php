<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request){

        // Validation
        // $rules = [];
        // $messages = [];
        // $validator = Validator::make($request->all(),$rules,$messages);
        // dd($request->all());
        $booking = new Booking();
        $booking->booking_date = now();
        $booking->customer_address = $request->address;
        $booking->customer_phone_number = $request->phone_number;
        $booking->customer_name = $request->name;
        $booking->customer_email = $request->email;
        $booking->is_registered_user = 0;
        $booking->save();


    }
}

