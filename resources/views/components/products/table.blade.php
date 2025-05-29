<div class="overflow-x-auto">
<table class="min-w-full bg-white dark:bg-zinc-700 rounded-lg shadow-lg">
    <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Photo</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Price</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Stock</th>
            @if($showView)
                <th class="border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 tracking-wider"></th>
            @endif
            @if($showEdit)
                <th class="border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 tracking-wider"></th>
            @endif
            @if($showDelete)
                <th class="border-b-2 border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 tracking-wider"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr class="hover:bg-gray-100 dark:hover:bg-zinc-600">
                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <img class="object-cover h-24 w-24 rounded" src="{{ $product->photo ? asset('storage/products/' . $product->photo) : 'https://www.opelgtsource.com/assets/default_product.png' }}" alt="{{ $product->name }}" />
                </td>
                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 dark:text-blue-300 hover:underline font-semibold">
                        {{ $product->name }}
                    </a>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    {{ number_format($product->price, 2) }}€/Kg
                </td>
                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    {{$product->stock}}
                </td>
                @if($showView)
                    <td class="ps-2 border-b border-gray-200 dark:border-gray-600 px-0.5">
                        <a href="{{ route('products.show', ['product' => $product]) }}">
                            <flux:icon.eye class="size-5 hover:text-green-600" />
                        </a>
                    </td>
                @endif
                @if($showEdit)
                    <td class="border-b border-gray-200 dark:border-gray-600 px-0.5">
                        <a href="{{ route('products.edit', ['product' => $product]) }}">
                            <flux:icon.pencil-square class="size-5 hover:text-blue-600" />
                        </a>
                    </td>
                @endif
                @if($showDelete)
                    <td class="border-b border-gray-200 dark:border-gray-600 px-0.5">
                        <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <flux:icon.trash class="size-5 hover:text-red-600" />
                            </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
</div>
