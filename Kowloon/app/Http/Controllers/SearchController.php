<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {

    	$categories = Category::all();
    	$searchCategories = "";
    	$searchCategoriesExplode = "";
    	$search = null;
    	$minValue = "";
    	$maxValue = "";

    	if (isset($request->search)) {
    		$search = $request->search;
    		$minValue = $request->minValue;
    		$maxValue = $request->maxValue;
    		if ($request->categories) {
    			$searchCategories = $request->categories;
    			$searchCategoriesExplode = explode("|", $searchCategories);
    			$products = Product::where(function ($query) use($search, $minValue, $maxValue, $searchCategoriesExplode)
				{
					$minValue = intval($minValue);
					$maxValue = intval($maxValue);
					foreach ($searchCategoriesExplode as $searchCategory) {
						$query->orWhere([['name', 'like', '%' . $search . '%'], ['price', '>', $minValue], ['price', '<', $maxValue], ['category_id', '=', $searchCategory]]);
						$query->orWhere([['description', 'like', '%' . $search . '%'], ['price', '>', $minValue], ['price', '<', $maxValue], ['category_id', '=', $searchCategory]]);
					}
					

				})->paginate(5);

				$products->appends(['search' => $search]);
				$products->appends(['minValue' => $minValue]);
				$products->appends(['maxValue' => $maxValue]);
				$products->appends(['categories' => $searchCategories]);
    		} else {
    			$products = Product::where(function ($query) use($search, $minValue, $maxValue)
				{
					$minValue = intval($minValue);
					$maxValue = intval($maxValue);

					$query->orWhere([['name', 'like', '%' . $search . '%'], ['price', '>', $minValue], ['price', '<', $maxValue]]);
					$query->orWhere([['description', 'like', '%' . $search . '%'], ['price', '>', $minValue], ['price', '<', $maxValue]]);
					

				})->paginate(5);

				$products->appends(['search' => $search]);
				$products->appends(['minValue' => $minValue]);
				$products->appends(['maxValue' => $maxValue]);
				$products->appends(['categories' => $searchCategories]);
    		}    		
    	}

    	return view('search.index', compact('categories', 'products', 'search', 'minValue', 'maxValue', 'searchCategoriesExplode'));
    }

    public function search(Request $request)
    {
    	$categories = "";

    	if ($request->categories != "") {
    		$categories = implode( "|" , $request->categories);
    	}
    	
    	return redirect('/search?search=' . $request->keyword . '&minValue=' . $request->minValue . '&maxValue=' . $request->maxValue . '&categories=' . $categories);
    }
}
