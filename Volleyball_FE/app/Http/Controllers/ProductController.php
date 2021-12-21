<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductSize;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function detail($id)
    {
        //$size = Product::find($id);
        $products = Product::find($id);
        $categories = Category::where('parent_id', 0)->get();
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        $productsRecommend = Product::Latest('views_count','desc')->take(12)->get();
        return view('product.detail', compact('categories','categoriesLimit', 'productsRecommend', 'products'));
    }

    public function search(Request $request)
    {
        $keyWords = $request->keyWords_submit;
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::Latest()->take(6)->get();
        $productsRecommend = Product::Latest('views_count','desc')->take(12)->get();
        $categoriesLimit = Category::where('parent_id', 0)->take(3)->get();

        $search_product = Product::where('name','like','%' . $keyWords . '%')->get();
//        $search_product = DB::table('products')->where('name','like','%' . $keyWords . '%')->get();
        return view('product.search',compact('categories', 'products', 'productsRecommend','categoriesLimit','search_product'));
    }

    public function tag(Request $request,$tag_name)
    {
//        echo 'abc: ' . $request->tag_name;
        $products = Product::Latest()->take(6)->get();
        $product_tag = Product::where('name','LIKE', '%'. $tag_name.'%')->orWhere('content','LIKE', '%'. $tag_name.'%')->get();
        $categories = Category::where('parent_id', 0)->get();
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        $productsRecommend = Product::Latest('views_count','desc')->take(12)->get();
        return view('product.tag.tag',
            compact('categories','categoriesLimit', 'productsRecommend','tag_name','product_tag','products'));
    }


}
