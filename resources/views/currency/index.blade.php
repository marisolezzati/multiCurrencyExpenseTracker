<x-layout>
    @foreach($currencies as $currency)
        <div>
            1 {{$currency->name}} = {{$currency->rate}} dolar.
        </div>
    @endforeach
</x-layout>
