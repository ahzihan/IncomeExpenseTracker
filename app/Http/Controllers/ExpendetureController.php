<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpendetureController extends Controller
{
    public function ExpenditurePage(Request $request){
        return view('pages.dashboard.expenditure-page');
    }

    function ExpenditureList(){
        $incomes = Income::all();
        $expenses = Expense::all();

        $totalIncome = 0;
        foreach ($incomes as $income) {
            $totalIncome += $income->amount;
        }

        $totalExpenses = 0;
        foreach ($expenses as $expense) {
            $totalExpenses += $expense->amount;
        }

        $netIncome = $totalIncome - $totalExpenses;
        $data[]=[
            'totalIncome'=>$totalIncome,
            'totalExpenses'=>$totalExpenses,
            'netIncome'=>$netIncome
        ];

        return $data;

    }

}
