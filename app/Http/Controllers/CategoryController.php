<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function CategoryPage():View{
        return view('pages.dashboard.category-page');
    }

    function CategoryList(Request $request){
        return Category::get();
    }

    function CategoryCreate(Request $request){
        return Category::create([
            'cat_name'=>$request->input('cat_name')
        ]);
    }

    function CategoryByID(Request $request){
        $cat_id=$request->input('id');
        return Category::where('id',$cat_id)->first();
    }

    function CategoryUpdate(Request $request){
        $cat_id=$request->input('id');
        return Category::where('id',$cat_id)->update([
            'cat_name'=>$request->input('cat_name')
        ]);
    }

    function CategoryDelete(Request $request){
        $cus_id=$request->input('id');
        return Category::where('id',$cus_id)->delete();
    }
}
