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
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Add new currency:
                            </h2>
                        </header>
                        <form action="{{ route('currency.store') }}" method="POST" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                                <input name="name" type="text" placeholder="Euro" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                            </div>
                            <div>
                                <label for="id" class="block font-medium text-sm text-gray-700">ISO code</label>
                                <input name="id" type="text" placeholder="EUR" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                            </div>
                            <div>
                                <label for="rate" class="block font-medium text-sm text-gray-700">Rate</label>
                                <input name="rate" type="text" placeholder="0.9" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                            </div>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </form>
                    </section>
                    </div>
                    <div class="list">
                    <section>
                        Currency list:
                        <table class="list">
                            <thead>
                                <tr class="item">
                                    <td>Currency name</td>
                                    <td class="numericItem">1 euro equas to</td>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total=0;        
                            @endphp
                            @foreach($currencies as $currency)
                                <tr class="item">
                                    <td>{{$currency->name}} </td>
                                    <td class="numericItem">{{$currency->rate}} {{$currency->id}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</x-app-layout>