<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'rate', 'cost', 'currency_id'];

    public function costInEuro(){
        return $this->cost/$this->rate;
    }

    public function currencyName(){
        return Currency::find($this->currency_id)->name;
    }
}
