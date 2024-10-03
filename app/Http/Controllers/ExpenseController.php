<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Currency;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::orderBy('name')->get();
        $expenses = Expense::query()->where('user_id', auth()->user()->id)->get();
        return view('expense.index', ['expenses'=>$expenses, 'currencies' => $currencies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        var_dump($request->user()->id);
        $data = $request->validate([
            'description'=> ['required','string'],
            'cost'=> ['required','numeric', 'min:0'],
            'currency_id'=> ['required','string'],
        ]);
        $data['user_id'] = $request->user()->id;
        $data['rate'] = Currency::find($data['currency_id'])->rate;
        var_dump($data);
        $expense = Expense::create($data);
        return to_route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(expense $expense)
    {
        $expense->delete();
        return to_route('expense.index');
    }
}
