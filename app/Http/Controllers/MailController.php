<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class MailController extends Controller
{
    public function SendEmail()
  {
   try {
        $toMailAddress = "sindhu.uja23@gmail.com";
        $WelcomeMessage = "Hey WHatsapp! This is a Mailtrap Message";

        $response = Mail::to($toMailAddress)->send(new Email($WelcomeMessage));
        dd($response);
    }
    catch (Exception $e)
    {
        \Log::error('unable send email' .$e->getMessage());
    }
}




}
