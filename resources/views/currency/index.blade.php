<x-layout>
    @foreach($currencies as $currency)
        <div>
        {{$currency->rate}} {{$currency->name}}=  1 dolar. 
        <form action="{{ route('currency.destroy', $currency) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
        <form action="{{ route('currency.edit', $currency) }}" method="GET">
            <button>Edit</button>
        </form>
        </div>
    @endforeach
</x-layout>
