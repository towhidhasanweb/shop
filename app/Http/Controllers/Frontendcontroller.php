<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class Frontendcontroller extends Controller
{
    function frontend_view(){
        $category_info = Category::all();
        $all_products = Product::all();
        return view('frontend.index', [
            'category_info' => $category_info,
            'all_products' => $all_products,
        ]);
    }
    
    function welcome(){
        return view('welcome');
    }
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
}
