<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">            
                    <div class="flex items-center gap-4">
                    Add new currency rate:
                        <form action="{{ route('currency.store') }}" method="POST" >
                            @csrf
                            1 EUR = <input name="rate" placeholder="Rate i.e:(0.9)"> <input name="name" placeholder="Currency name i.e:(EUR)">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </form>
                    </div>
                    <div class="flex items-center gap-4">
                        <form action="{{ route('currency.create') }}" method="GET" >
                            @csrf
                            <x-primary-button>{{ __('Refresh rates') }}</x-primary-button>
                        </form>
                    </div>
                    Currency list:
                    <table class="list">
                        <tbody>
                        @php
                            $total=0;        
                        @endphp
                        @foreach($currencies as $currency)
                            <tr class="item">
                                <td>{{$currency->rate}} {{$currency->id}} ({{$currency->name}}) =  1 EUR.</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
</x-app-layout>