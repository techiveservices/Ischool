<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class EmailController extends Controller
{
    //

   public function sendFeedback()
{
   $comment = 'Hi, This test feedback.';
   $toEmail = "varunindian10@gmail.com";
   Mail::to($toEmail)->send(new FeedbackMail($comment));
   
   return 'Email has been sent to '. $toEmail;
}
public function sendEmail(){
	$to_name = 'TO_NAME';
$to_email = 'varunindian10@gmail.com';
$data = array('name'=>"Varun Kumar", "body" => "Test mail");
    
Mail::send('email.feedback', compact('data'), function($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)
            ->subject('Testing Email');
    $message->from('support@techive.in','Techive Pvt Ltd');
});
}

}
