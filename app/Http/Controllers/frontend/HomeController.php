<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Item,Category};
class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $recentproducts = Product::latest()->paginate(4); // Fetch 4 products per page
        $items = Item::all();
    
        return view('frontend.index', compact('categories', 'products', 'items', 'recentproducts'));
    }

    public function cart()
{
    return view('frontend.cart');
}

}
