<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\HotItem;
use DB;
use Lang;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->cookie('language')) {
    		$language = $request->cookie('language');

    		Lang::setLocale($language);
    	}    	

    	$categories = Category::All();

    	$hotItems = HotItem::orderBy('place', 'ASC')->get();

    	return view('home.index', compact('categories', 'hotItems'));
    }
}
