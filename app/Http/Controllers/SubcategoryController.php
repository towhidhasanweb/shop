<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function subcategory(){
        $category_name =  Category::all();
        $subcategory_info = Subcategory::all();
        $trash_subcategory = Subcategory::onlyTrashed()->get() ;
        return view('admin.category.subcategory',[
            'category_name' =>$category_name,
            'subcategory_info'=>$subcategory_info,
            'trash_subcategory'=>$trash_subcategory,
        ]);
    }

    function add_subcategory(SubcategoryRequest $request){
        if(Subcategory::where('category_id', $request->category)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('exist', 'Subcategory name already exist is this category');
        } else{
            Subcategory::insert([
                'category_id'=>$request->category,
                'subcategory_name'=>$request->subcategory_name,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success', 'Sub category created!');
        }
        
        
    }
    function delete_subcategory($subcategory_id){
        Subcategory::find($subcategory_id)->delete();
        return back()->with('delete', 'Sub category deleted successfullay!');
    }
    function harddelete_subcategory($subcategory_id){
        Subcategory::onlyTrashed()->find($subcategory_id)->forceDelete();
        return back()->with('delete', 'subcategory deleted successfullay!');
    }
    function restore_subcategory($subcategory_id){
        Subcategory::onlyTrashed()->find($subcategory_id)->restore();
        return back()->with('restore', 'Subcategory restore successfullay');
    }
    function edit_subcategory($subcategory_id){
        $subcategory_info = Subcategory::find($subcategory_id);
        $category_name = Category::all();
        return view('admin.category.edit-subcategory',[
            'subcategory_info'=>$subcategory_info,
            'category_name'=>$category_name,
        ]);
    }
    function update_subcategory(Request $request){
        Subcategory::find($request->subcategory_id)->update([
            'subcategory_name'=>$request->subcategory_name,
        ]);
        return redirect('/subcategory')->with('success', 'category updated successfully');
    }
}
