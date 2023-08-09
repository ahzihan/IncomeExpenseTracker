<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    function ExpensePage():View{
        return view('pages.dashboard.expense-page');
    }

    function ExpenseList(Request $request){
        $user_id=$request->header('id');
        return Expense::with('category', 'user')->where('user_id', $user_id)->get();
    }

    function ExpenseCreate(Request $request){
        $user_id=$request->header('id');
        return Expense::create([
            'entryDate'=>$request->input('entryDate'),
            'cat_id'=>$request->input('cat_id'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'user_id'=>$user_id
        ]);
    }

    function ExpenseByID(Request $request){
        $id=$request->input('id');
        $user_id=$request->header('id');
        return Expense::where('id',$id)->where('user_id',$user_id)->first();
    }

    function ExpenseUpdate(Request $request){
        $id=$request->input('id');
        $user_id=$request->header('id');
        return Expense::where('id',$id)->where('user_id',$user_id)->update([
            'entryDate'=>$request->input('entryDate'),
            'cat_id'=>$request->input('cat_id'),
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description')
        ]);
    }

    function ExpenseDelete(Request $request){
        $id=$request->input('id');
        $user_id=$request->header('id');
        return Expense::where('id',$id)->where('user_id',$user_id)->delete();
    }
}
