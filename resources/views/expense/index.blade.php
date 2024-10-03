<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expenses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="new"> 
                        Add new expense rate:
                        <form action="{{ route('expense.store') }}" method="POST" >
                            @csrf
                            Description: <input name="description">
                            Amount: <input name="cost"/> 
                            Currency <select name="currency_id" required>
                                <option value="">-</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}" {{ $currency->id == old('currency_id') ? 'selected' : '' }}>{{ $currency->id }} - {{ $currency->name }}</option>
                                @endforeach
                            </select>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
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
                                <td>Cost in EUR</td>
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
                                    $costInEuro = $expense->costInEuro();
                                    $total += $costInEuro;
                                    echo(number_format($costInEuro, 2, '.', ','));
                                    @endphp              
                                </td> {{-- TODO set locale for decimal symbol --}}
                                <td>
                                    <form action="{{ route('expense.destroy', $expense) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button>{{ __('Delete') }}</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                            <tr class="total">
                                <td colspan="4">Total</td>
                                <td class="numericItem">{{number_format($total, 2, '.', ',')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
</x-app-layout>