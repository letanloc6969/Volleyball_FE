<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug, $categoryId)
    {
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::where('category_id', $categoryId)->paginate(3);
        $categoriesLimit = Category::where('parent_id', 0)->take(3)->get();
        return view('product.category.list',compact('categories', 'products','categoriesLimit'));
    }
}
