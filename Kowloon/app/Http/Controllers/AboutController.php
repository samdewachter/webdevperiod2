<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Mail;

class AboutController extends Controller
{
    public function index()
    {
    	$faqs = Faq::all();

    	return view('about.index', compact('faqs'));
    }

    public function contact(Request $request)
    {
    	$this->validate($request, [
            'email' => 'required|email',
            'text' => 'required'
        ]);

        $emailFrom =  $request->email;
        $emailText =  $request->text;


        Mail::send('emails.contact', ["emailFrom" => $emailFrom, "emailText" => $emailText], function ($message)
        {

            $message->from('samdewachter@gmail.com', 'Kowloon')
            		->subject('Contact');

            $message->to('samdewachter@hotmail.com');

        });

    	return back()->with('success', 'Contact email is succesvol verzonden!');
    }
}
