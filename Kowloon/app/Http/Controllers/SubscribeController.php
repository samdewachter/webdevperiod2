<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Mail;

class SubscribeController extends Controller
{
    public function index(Request $request)
    {
    	$this->validate($request, [
            'email' => 'required|email',
        ]);

    	$subscriber = new Subscriber();

    	$subscriber->email = $request->email;

    	if (!$subscriber->save()) {
    		return "Subscriber not saved successfully";
    	}

        $emailTo =  $subscriber->email;

        Mail::send('emails.subscribe', [], function ($message)
        {

            $message->from('samdewachter@gmail.com', 'Kowloon')
            		->subject('Subscribed to Kowloon newsletter');

            $message->to('samdewachter@hotmail.com');

        });

    	return back()->with('success', 'U bent succesvol geabonneerd op onze nieuwsbrief!');
    }
}
