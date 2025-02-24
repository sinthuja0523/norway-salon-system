<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ReportView()
    {
        $report = DB::table('appointments')
        ->join('customers', 'appointments.customer_id', '=', 'customers.id');
    }
}
