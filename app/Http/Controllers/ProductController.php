<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Productgallery;
use App\Models\Size;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function add_product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.product.add-product',[
            'categories'=> $categories,
            'subcategories'=> $subcategories,
        ]);
    }
    function product_list(){
        $products_info = Product::all();
        return view('admin.product.product-list', [
            'products_info'=>$products_info,
        ]);
    }
    function getsubcategory(Request $request){
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        $str = '<option value="">-- Select Subcategory --</option>';
        foreach ($subcategories as $subcategory){
            $str .= "<option value='$subcategory->id'>$subcategory->subcategory_name</option>";
        }
        echo $str;
    }

    function product_upload(Request $request){
        
        $name = str_replace(' ', '-', $request->product_name);
        $slug = Str::lower($name).'-'.random_int(10000,99999);
        $product_id = Product::insertGetId([
            'category_id'=> $request->category_id,
            'subcategory_id'=> $request->subcategory_id,
            'product_name'=> $request->product_name,
            'slug'=>$slug,
            'product_brand'=>$request->product_brand,
            'product_price'=>$request->product_price,
            'discount'=>$request->discount_price,
            'after_discount'=>$request->product_price - ($request->product_price*$request->discount_price/100),
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'created_at'=>Carbon::now(),
        ]);
        
        $thumbnails = $request->preview;
        $extension = $thumbnails->getClientOriginalExtension();

        $file_name = Str::lower($name).$product_id.'.'.$extension;
        Image::make($thumbnails)->resize(600, 600)->save(public_path('/upload/product/thumbnails/'.$file_name));
        Product::find($product_id)->update([
            'thumbnails'=>$file_name,
        ]);

        $product_gallery = $request->product_gallery;
        $key_num = 1;

        foreach($product_gallery as $gallery){
            $gallery_extension = $gallery->getClientOriginalExtension();
            $gallery_name = Str::lower($name).$product_id.$key_num++.'.'.$gallery_extension;
            Image::make($gallery)->resize(600,600)->save(public_path('/upload/product/gallery/'.$gallery_name));

            Productgallery::insert([
                'product_id'=>$product_id,
                'gallery_image'=>$gallery_name,
                'created_at'=>Carbon::now(),
            ]);
        }

        return back()->with('success', 'Product Added!');

    }

    function color_size(){
        $color_info = Color::all();
        $size_info= Size::all();
        return view('admin.product.color-size', [
            'color_info'=>$color_info,
            'size_info'=>$size_info,
        ]);
    }

    function add_color(Request $request){

        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
        ]);
        return back()->with('color_success', 'Color added!');
    }
    function add_size(Request $request){
        Size::insert([
            'size_name'=>$request->size_name,
        ]);
        return back()->with('size_success', 'Size added!');
    }

    function inventory($product_id){
        $product_info = Product::find($product_id);
        $color_info = Color::all();
        $size_info = Size::all();
        $inventory_info = Inventory::where('product_id', $product_id)->get();
        return view('admin.product.inventory',[
            'product_info'=>$product_info,
            'color_info'=>$color_info,
            'size_info'=>$size_info,
            'inventory_info'=>$inventory_info,
        ]);
    }

    function inventory_store(Request $request){

        if(Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_name)->where('size_id', $request->size_name)->exists()){
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_name)->where('size_id', $request->size_name)->increment('quantity', $request->quantity);
        }else{
            Inventory::insert([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_name,
                'size_id'=>$request->size_name,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
        };

        
        return back()->with('inventory_added', 'Inventory added successfully!');
    }
    function inventory_edit($inventory_id){
        
        $inventory_edit = Inventory::all();
        $color_info = Color::all();
        $size_info = Size::all();
        $inventory_info = Inventory::find($inventory_id);
        return view('admin.product.edit-inventory',[
            
            'color_info'=>$color_info,
            'size_info'=>$size_info,
            'inventory_info'=>$inventory_info,
            'inventory_edit'=>$inventory_edit,
        ]);
    }

    function edit_inventory_store(Request $request){
        $product_id = Inventory::find($request->inventory_id)->product_id;
        Inventory::find($request->inventory_id)->update([
            'color_id'=>$request->color_name,
            'size_id'=>$request->size_name,
            'quantity'=>$request->quantity,
        ]);
        return redirect('/inventory/'.$product_id)->with('inventory_added', 'Inventory added successfully!');
    }
    
    
}
