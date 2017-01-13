<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use App\product;
use App\Category;
use App\Category_product;
use App\HotItem;
use App\FaqProduct;
use App\Faq_product;
use App\Tag;
use App\Photo;
use App\Color;
use DB;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.index');
    }

    public function products()
    {
        $products = Product::all();

        $hotItems = HotItem::orderBy('place', 'ASC')->get();

    	return view('admin.products', compact('products', 'hotItems'));
    }

    public function newProduct()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $colors = Color::all();

        return view('admin.newProduct', compact('categories', 'tags', 'colors'));
    }

    public function makeProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
            'technicalText' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png|max:5120',
            'color_id' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $nameExplode = explode(" ", $request->name);
        $nameImplode = implode("-", $nameExplode);
        $product->url = $nameImplode;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->tag_id = $request->tag_id;
        $product->technicalText = $request->technicalText;

        $files = $request->file('photo');

        if (!$product->save()) {
            return redirect('admindashboard/products')->with('error', 'Product is niet succesvol aangemaakt.');
        }

        foreach ($files as $file) {

            $imageName = $file->getClientOriginalName();
            $imageName = rand(0, 10000) . $imageName;
            $file->move(base_path() . '/public/uploads/products', $imageName);

            $photo = new Photo();

            $photo->name = $imageName;
            $photo->product_id = $product->id;

            $photo->save();
          
        }

        $colors = $request->color_id;

        foreach($colors as $color) {
            $product->Colors()->attach($color);
        }        

        return redirect('admindashboard/products')->with('success', 'Product is succesvol aangemaakt.');
    }

    public function deleteProduct(Product $product)
    {
        $product->Colors()->detach();

        $productId = $product->id;

        $hotItem = HotItem::where('product_id', '=', $productId)->first();
        if ($hotItem != null) {
            return back()->with('error', 'U probeert een hot item te verwijderen, verwissel eerst het product en verwijder het dan pas.');
        }

        if(!$product->delete()) {
            return back()->with('error', 'Product is niet succesvol verwijderd.');
        }

        return back()->with('success', 'Product is succesvol verwijderd.');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $hotItems = HotItem::orderBy('place', 'ASC')->get();
        $colors = Color::all();

        return view('admin.editProduct', compact('product', 'categories', 'hotItems', 'tags', 'colors'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|unique:products,name,'.$product->id,
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
            'technicalText' => 'required',
            'color_id' => 'required',
            'photo' => 'mimes:jpg,jpeg,png|max:5120'
        ]);

        $product->name = $request->name;
        $nameExplode = explode(" ", $request->name);
        $nameImplode = implode("-", $nameExplode);
        $product->url = $nameImplode;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->tag_id = $request->tag_id;
        $product->technicalText = $request->technicalText;

        if (count($product->colors) != 0) {            
            foreach ($product->colors as $productColor) {
                $colorChecked = false;
                foreach($request->color_id as $requestColor) {
                    if ($productColor->id == $requestColor) {
                        $colorChecked = true;
                    }
                }
                if (!$colorChecked) {
                    $product->colors()->detach($productColor->id);
                }
            }
            foreach ($request->color_id as $requestColor) {
                $colorExist = false;
                foreach($product->colors as $productColor) {
                    if ($productColor->id == $requestColor) {
                        $colorExist = true;
                    }
                }
                if (!$colorExist) {
                    $product->colors()->attach($requestColor);
                }
            }
        }
        else {
            $colors = $request->color_id;

            foreach ($colors as $color) {
                $product->Colors()->attach($color);
            }
        }
        
        $product->save();

        if ($request->file('photo') != NULL) {

            $files = $request->file('photo');

            foreach ($files as $file) {

                $imageName = $file->getClientOriginalName();
                $imageName = rand(0, 10000) . $imageName;
                $file->move(base_path() . '/public/uploads/products', $imageName);

                $photo = new Photo();

                $photo->name = $imageName;
                $photo->product_id = $product->id;

                $photo->save();
              
            }
        }

        if ($request->deletePhoto != null) {

            $photos = $request->deletePhoto;

            foreach ($photos as $photo) {
                $deletePhoto = Photo::find($photo);

                $deletePhoto->delete();
            }
        }

        if ($request->place == 4) {
            return redirect('admindashboard/products')->with('success', 'Product is succesvol aangepast.');
        }

        if (count($product->hotItems) == 1) {
            $hotItem1 = HotItem::where('place', $request->place)->get();
            $hotItem1 = HotItem::find($hotItem1[0]->id);

            $hotItem2 = HotItem::where('place', $product->hotItems[0]->place)->get();
            $hotItem2 = HotItem::find($hotItem2[0]->id);

            $place1 = $hotItem1->place;
            $place2 = $hotItem2->place;

            $hotItem1->place = $place2;
            $hotItem2->place = $place1;

            $hotItem1->save();
            $hotItem2->save();

            $hotItem = HotItem::where('place', $request->place)->get();
            $hotItem = HotItem::find($hotItem[0]->id);
        }

        $hotItem = HotItem::where('place', $request->place)->get();
        $hotItem = HotItem::find($hotItem[0]->id);

        $hotItem->product_id = $product->id;

        $hotItem->save();        

        return redirect('admindashboard/products')->with('success', 'Product is succesvol aangepast.');
    }

    public function editFaqProduct(Product $product)
    {
        $faqs = Faq::all();

        return view('admin.editFaqProduct', compact('product', 'faqs'));
    }

    public function addFaqProduct($product, $faq)
    {
        $faqProduct = new FaqProduct();
        $faqProduct->product_id = $product;
        $faqProduct->faq_id = $faq;

        $faqProduct->save();

        return back()->with('success', 'FAQ is succesvol aangewezen.');
    }

    public function deleteFaqProduct(Product $product, $faqproduct)
    {
        $product->Faqs()->detach($faqproduct);

        return back()->with('success', 'FAQ is succesvol verwijderd van het product.');
    }

    public function faq()
    {
        $faqs = DB::table('faqs')->paginate(5);

    	return view('admin.faq', compact('faqs'));
    }

    public function newFaq()
    {
        return view('admin.newFaq');
    }

    public function createFaq(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = new Faq();

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        if (!$faq->save()) {
            return redirect('admindashboard/faq')->with('error', 'FAQ is niet succesvol aangemaakt.');
        }

        return redirect('admindashboard/faq')->with('success', 'FAQ is succesvol aangemaakt.');

    }

    public function deleteFaq(Faq $faq)
    {
        $faq->delete();

        return back()->with('success', 'FAQ is succesvol verwijderd.');
    }

    public function editFaq(Faq $faq)
    {
        return view('admin.editFaq', compact('faq'));
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        $faq->save();

        return redirect('admindashboard/faq')->with('success', 'FAQ is succesvol gewijzigd.');
    }
}
