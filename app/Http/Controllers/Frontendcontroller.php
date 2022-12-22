<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Productgallery;
use Illuminate\Http\Request;

class Frontendcontroller extends Controller
{
    function frontend_view(){
        $category_info = Category::all();
        $all_products = Product::all();
        $new_products = Product::latest()->take(4)->get();
        return view('frontend.index', [
            'category_info' => $category_info,
            'all_products' => $all_products,
            'new_products' => $new_products,
        ]);
    }
    function product_details($product_slug){
        $product_details = Product::where('slug', $product_slug)->get();
        $product_gallery = Productgallery::where('product_id', $product_details->first()->id)->get();
        $related_product = Product::where('category_id', $product_details->first()->category_id)->where('id', '!=', $product_details->first()->id)->get();
        $all_colors = Inventory::where('product_id', $product_details->first()->id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get();
        return view('frontend.product-details', [
            'product_details'=> $product_details,
            'product_gallery'=> $product_gallery,
            'related_product'=> $related_product,
            'all_colors'=> $all_colors,
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
    function getsizeid(Request $request){
        $strr = '<option value="">Choose A Size</option>';
        $all_size = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach($all_size as $size){
            $strr .= '<option value="'.$size->size_id.'">'.$size->rel_to_size->size_name.'</option>';
        }
        echo $strr;

    }

    function customer_login(){
        return view('frontend.customer-login');
    }
    
}
