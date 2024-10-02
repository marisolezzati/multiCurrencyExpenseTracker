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
        return view('expense.index', ['expenses'=>Expense::all(), 'currencies' => Currency::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description'=> ['required','string'],
            'cost'=> ['required','numeric', 'min:0'],
            'currency_id'=> ['required','string'],
        ]);
        $data['rate'] = Currency::find($data['currency_id'])->rate;
        $expense = Expense::create($data);
        return to_route('expense.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(expense $expense)
    {
        return view('expense.show', ['expense'=>$expense]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expense $expense)
    {
        return view('expense.edit', ['expense'=>$expense]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, expense $expense)
    {
        $data = $request->validate([
            'description'=> ['required','string'],
            'cost'=> ['required','numeric', 'min:0'],
            'currency_id'=> ['required','numeric'],
        ]);
        $expense->update($data);
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
