<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'rate', 'cost', 'currency_id', 'user_id'];

    public function costInBase(){
        $cost = $this->cost;
        if($this->currency_id != auth()->user()->base_currency){
            //the expense is not in the users prefered currency
            $baseCurrency = Currency::find(auth()->user()->base_currency);
            //internally rates are stored using base Euro
            //divide by $this->rate to convert to Euro, and multply by Base currency to convery Euro to the user's base currency
            $cost = ($this->cost/$this->rate)*$baseCurrency->rate;
        }
        return $cost;
    }

    public function currencyName(){
        return Currency::find($this->currency_id)->name;
    }
}
