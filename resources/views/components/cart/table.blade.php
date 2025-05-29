{{-- filepath: resources/views/components/cart/table.blade.php --}}
@php
    $cartTotal = 0;
@endphp
<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Quantity</th>
            <th class="px-4 py-2">Total</th>

            <th class="px-4 py-2">Remove</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            @php
                $lineTotal = $product->price * ($product->quantity ?? 1);
                $cartTotal += $lineTotal;
            @endphp
            <tr>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ number_format($product->price, 2) }} €</td>
                <td class="px-4 py-2">
                    <div class="inline-flex items-center bg-white rounded h-8 border text-gray-600 inline-flex items-center px-2 py-1 border-r border-gray-200 dark:bg-zinc-500 dark:text-gray-200">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <div class="bg-gray-100 dark:bg-zinc-600 px-4 py-1">
                            {{ $product->quantity ?? 1 }}
                        </div>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </td>
                <td class="px-4 py-2"> {{ number_format($lineTotal, 2) }} €</td>
                <td class="px-4 py-2">
                    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="px-4 py-2 text-right font-bold">Total:</td>
            <td class="px-4 py-2 font-bold">{{ number_format($cartTotal, 2) }} €</td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>
