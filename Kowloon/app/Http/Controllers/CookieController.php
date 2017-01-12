<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function makeCookie()
    {
    	return back()->withCookie(cookie()->forever('firsttime', 'OK'));
    }
}
