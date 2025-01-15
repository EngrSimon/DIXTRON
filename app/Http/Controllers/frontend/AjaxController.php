<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;

class AjaxController extends Controller
{
    public function getProducts($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json(['products' => $products]);
    }

    public function getItems($productId)
    {
        $items = Item::where('product_id', $productId)->get();
        return response()->json(['items' => $items]);
    }
}
