<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;

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
    public function store(StoreCurrencyRequest $request)
    {
        return view('currency.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return view('currency.show', ['currencies'=>$currencies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('currency.edit', ['currencies'=>$currencies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        return view('currency.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        return view('currency.destroy');
    }
}
