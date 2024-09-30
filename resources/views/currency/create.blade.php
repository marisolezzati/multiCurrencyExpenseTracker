<x-layout>
    <form action="{{ route('currency.store') }}" method="POST" >
        @csrf
        Currency <input name="name" rows="10" class="currency-body">
        Rate <input name="rate" rows="10" class="currency-body"> dolar
                <a href="{{ route('currency.index') }}" class="currency-cancel-button">Cancel</a>
            <button>Submit</button>
    </form>
</x-layout>
