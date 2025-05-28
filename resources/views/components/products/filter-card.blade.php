<!-- filepath: resources/views/components/products/filter-card.blade.php -->
<form method="GET" action="{{ route('products.index') }}" class="mb-6">
    <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
    <select name="category" id="category" class="block w-md rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
</form>
