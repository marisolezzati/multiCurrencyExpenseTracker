<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{

    public function index()
    {
        $currencies = Currency::all();
        return view('currency.index', ['currencies'=>$currencies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ['required','string'],
            'country'=> ['required','string'],
            'rate'=> ['required','numeric', 'min:0'],
        ]);
        $currency = Currency::create($data);
        return to_route('currency.index');
    }

    /**
     * Populates currencies table with data from the API
     */
    public function create()
    {
        $result =CurrencyService::getRates();
        if($result!=null) {
            // Handle any errors that occur during the API request
            return view('currency.api_error', ['error' => $result->getMessage()]);
        }
        else{
            return to_route('currency.index');
        }
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
