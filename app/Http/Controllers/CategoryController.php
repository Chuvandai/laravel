<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        $categories = Category::all();

        return view('clients.category-products', compact('category', 'products', 'categories'));
    }
} 