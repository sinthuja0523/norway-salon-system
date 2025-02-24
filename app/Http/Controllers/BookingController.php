<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingService;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(){
        $services = \DB::table('services')->get();
        $branches = \DB::table('branches')->get();
        $time_slots = \DB::table('time_slots')->get();
        return view('pages.home',compact('branches','services','time_slots'));
    }
    public function store(Request $request){

        // Validation
        // $rules = [];
        // $messages = [];
        // $validator = Validator::make($request->all(),$rules,$messages);
        // dd($request->all());
        \Log::info('Store fcuntion loaded');
        \Log::info($request->all());
        $formData = $request->input('formData');

        // Date

        $date = $formData['date'];
        $timeSlot = $formData['time_slot'];
        $dateTimeString = $date . ' ' . $timeSlot;
        $dateTime = Carbon::parse($dateTimeString);

        // Storing in bookings table

        $booking = new Booking();
        $booking->booking_date =  $dateTime;
        $booking->customer_address = $formData['address'];
        $booking->customer_phone_number = $formData['phone_number'];
        $booking->customer_name = $formData['name'];
        $booking->customer_email = $formData['email'];
        $booking->is_registered_user = 0;
        $booking->save();

        // Storing in bookings_services table

        foreach ($formData['service_ids'] as $key => $new) {
            $data = new BookingService();
            $data->booking_id = $booking->id;
            $data->service_id = $new;
            $data->save();
        }


    }
}

