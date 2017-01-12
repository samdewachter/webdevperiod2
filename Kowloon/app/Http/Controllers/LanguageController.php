<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
    	$language = $request->lang;

    	return back()->withCookie(cookie()->forever('language', $language));;
    }
}
