<x-layout>
    <form action="{{ route('currency.update', $currency) }}" method="POST" >
        @csrf
        @method('PUT')
        <div>
            Currency name: <input name="name" rows="10" class="currency-body" value="{{ $currency->name }}">
            Rate <input name="rate" rows="10" class="currency-body" value="{{ $currency->rate }}"> = 1 dolar
        </div>
            <button>Submit</button>
    </form>
</x-layout>