<x-layout>
    <div class="new"> 
    Add new expense rate:
        <form action="{{ route('expense.store') }}" method="POST" >
            @csrf
            Description: <input name="description" placeholder="Rate i.e:(0.9)">
            Amount: <input name="cost"/> 
            Currency <select name="currency_id" required>
                <option value="">-</option>
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ $currency->id == old('currency_id') ? 'selected' : '' }}>{{ $currency->name }}</option>
                @endforeach
            </select>
            <button>Submit</button>
        </form>
    </div>
    Expense list:
    <table class="list">
        <thead>
            <tr class="item">
                <td>Expense</td>
                <td>Cost</td>
                <td>Original currency</td>
                <td>Rate*</td>
                <td>Cost in USD</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        @php
            $total=0;
        @endphp
        @foreach($expenses as $expense)
            <tr class="item">
                <td>{{$expense->description}}</td>
                <td class="numericItem">{{$expense->cost}}</td>
                <td>{{$expense->currencyName()}}</td>
                <td class="numericItem">{{$expense->rate}}</td>
                <td class="numericItem">@php
                    $costInUSD = $expense->costInUSD();
                    $total += $costInUSD;
                    echo(number_format($costInUSD, 2, '.', ','));
                    @endphp              
                </td> {{-- TODO set locale for decimal symbol --}}
                <td>
                    <form action="{{ route('expense.destroy', $expense) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
            <tr class="total">
                <td colspan="4">Total</td>
                <td>{{number_format($total, 2, '.', ',')}}</td>
            </tr>
        </tbody>
    </table>
</x-layout>