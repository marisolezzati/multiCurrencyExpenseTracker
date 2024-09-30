<x-layout>

    <div>
        <form action="{{ route('currency.update', $currency) }}" method="POST" >
            @csrf
            @method('PUT')
            <div>
                Currency name: <input name="name" rows="10" class="currency-body" value="{{ $currency->name }}">
            </div>
            <div>
                Rate <input name="rate" rows="10" class="currency-body" value="{{ $currency->rate }}"> = 1 dolar
                 <a href="{{ route('currency.index') }}" class="currency-cancel-button">Cancel</a>
                 </div>
                <button>Submit</button>
        </form>
    </div>
</x-layout>