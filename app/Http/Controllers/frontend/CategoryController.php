<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories.
     */
    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Get a category with its products.
     */
    public function getCategoryWithProducts($id)
    {
        $category = Category::with('products')->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }

    /**
     * Get all products with their items.
     */
    public function getProductsWithItems()
    {
        $products = \App\Models\Product::with('productItems')->get();
        return response()->json($products, 200);
    }
}
