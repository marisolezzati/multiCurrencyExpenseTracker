<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::query()->get();
        return view('currency.index', ['currencies'=>$currencies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('currency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ['required','string'],
            'rate'=> ['required','numeric', 'min:0'],
        ]);
        $currency = Currency::create($data);
        return to_route('currency.index')->with('message','Currency created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return view('currency.show', ['currency'=>$currency]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('currency.edit', ['currency'=>$currency]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $data = $request->validate([
            'name'=> ['required','string'],
            'rate'=> ['required','numeric', 'min:0'],

        ]);
        $currency->update($data);
        return to_route('currency.index')->with('message','Currency up');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return to_route('currency.index')->with('message','Currency deleted');
    }
}
