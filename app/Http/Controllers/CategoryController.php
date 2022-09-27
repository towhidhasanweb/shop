<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category(){
        $all_categorys = Category::all();
        $trash_category = Category::onlyTrashed()->get();
        return view('admin.category.index',[
            'all_categorys'=>$all_categorys,
            'trash_category'=>$trash_category,
        ]);
    }
    function add_category(CategoryRequest $request){
        if($request->category_image != ""){
            $category_id = Category::insertGetId([
                'category_name'=>$request->category_name,
                'added_by'=>Auth::id(),
                'created_at'=>Carbon::now(),
            ]);
            $category_image = $request->category_image;
            $extension = $category_image->getClientOriginalExtension();
            $image_name = $request->category_name.$category_id.'.'.$extension;
            Image::make($category_image)->save(public_path('upload/category/'.$image_name));
            Category::where('id', $category_id)->update([
                'category_image'=>$image_name,
            ]);
        }else{
            $category_id = Category::insertGetId([
                'category_name'=>$request->category_name,
                'added_by'=>Auth::id(),
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->with('success', 'Category added!');
    }
    function delete_category($category_id){
        Category::find($category_id)->delete();
        
        return back()->with('delete', 'Category deleted successfully');
    }
    
    function harddelete_category($category_id){
        if(Category::onlyTrashed()->find($category_id)->category_image != "default.png"){
        $image_delete= public_path('upload/category/'.Category::onlyTrashed()->find($category_id)->category_image);
        unlink($image_delete);
        Category::onlyTrashed()->find($category_id)->forceDelete();
        }else{
            Category::onlyTrashed()->find($category_id)->forceDelete();
        };

        return back()->with('hard_delete', 'Category deleted successfully');
    }
    function restore_category($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('restore', 'Category restored successfully');
    }
    function edit_category($category_id){
        $category_info = Category::find($category_id);
        return view('admin.category.edit-category',[
            'category_info'=>$category_info,
        ]);
    }

    function update_category(CategoryRequest $request){
        if($request->category_image == ''){
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
            ]);
        }else{
            $image = $request->category_image;
            $delete_image = public_path('upload/category/').Category::find($request->category_id)->category_image;
            unlink($delete_image);
            $image_ext = $image->getClientOriginalExtension();
            $image_name = $request->category_name.$request->category_id.'.'.$image_ext;
            
            Image::make($image)->save(public_path('upload/category/'.$image_name));
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'category_image'=>$image_name,
            ]);
        }
        return redirect('/category-list')->with('success', 'category updated successfully');
    }
}
