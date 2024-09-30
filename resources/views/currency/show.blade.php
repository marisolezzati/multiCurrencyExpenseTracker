<x-layout>
    <div>
        <div>
            <a href="{{ route('currency.edit', $currency) }}">Edit</a>
            <form action="{{ route('currency.destroy', $currency) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        <div>
            {{ $currency->currency }}
        </div>
    </div>
</x-layout>