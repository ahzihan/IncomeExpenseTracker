<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\View\View;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    function IncomePage():View{
        return view('pages.dashboard.income-page');
    }

    function IncomeList(Request $request){
        $user_id=$request->header('id');
        return Income::where('user_id',$user_id)->get();
    }

    function IncomeCreate(Request $request){
        $user_id=$request->header('id');
        return Income::create([
            'entryDate'=>$request->input('entryDate'),
            'cat_id'=>$request->input('cat_id'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'user_id'=>$user_id
        ]);
    }

    function IncomeByID(Request $request){
        $id=$request->input('id');
        $user_id=$request->header('id');
        return Income::where('id',$id)->where('user_id',$user_id)->first();
    }

    function IncomeUpdate(Request $request){
        $id=$request->input('id');
        $user_id=$request->header('id');
        return Income::where('id',$id)->where('user_id',$user_id)->update([
            'entryDate'=>$request->input('entryDate'),
            'cat_id'=>$request->input('cat_id'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description')
        ]);
    }

    function IncomeDelete(Request $request){
        $id=$request->input('id');
        $user_id=$request->header('id');
        return Income::where('id',$id)->where('user_id',$user_id)->delete();
    }
}
