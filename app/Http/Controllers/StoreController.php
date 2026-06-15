<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('user.store', compact('categories'));
    }

    public function category(Category $category)
    {
        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->latest()
            ->get();

        return view(
            'user.category-products',
            compact(
                'category',
                'products'
            )
        );
    }
}