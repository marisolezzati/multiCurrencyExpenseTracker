<x-layout>
    <div class="new"> 
    Add new currency rate:
        <form action="{{ route('currency.store') }}" method="POST" >
            @csrf
            1 EUR = <input name="rate" placeholder="Rate i.e:(0.9)"> <input name="name" placeholder="Currency name i.e:(Euro)">
            <button>Submit</button>
        </form>
    </div>
    <div class="list">
    Currency list:
        @foreach($currencies as $currency)
            <div class="item">
                {{$currency->rate}} {{$currency->name}} =  1 EUR. 
                <form action="{{ route('currency.destroy', $currency) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</x-layout>
