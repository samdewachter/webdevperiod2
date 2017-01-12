<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use DB;

class FAQController extends Controller
{
	public function index(Request $request)
	{
		if (isset($request->search)) {
			$search = $request->search;

			$faqs = DB::table('faqs')
					->where('answer', 'like', '%' . $search . '%')
					->orWhere('question', 'like', '%' . $search . '%')
					->paginate(5);

			$faqs->appends(['search' => $search]);

			return view('FAQ.index', compact('faqs', 'search'));
		}
		else {
			$faqs = DB::table('faqs')->paginate(5);

			return view('FAQ.index', compact('faqs'));
		}		
	}

	public function search(Request $request)
	{		

		return redirect('/FAQ?search=' . $request->keyword);
	}
}
