{{-- filepath: resources/views/components/products/table.blade.php --}}
<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Category</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ number_format($product->price, 2) }} €</td>
                <td class="px-4 py-2">{{ $product->category->name ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
