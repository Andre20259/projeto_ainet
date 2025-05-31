<form method="GET" action="{{ route('products.index') }}" class="mb-6">
    <div class="flex gap-4">
        <div class="flex-1">
            <label for="category" class="block mb-2 text-sm font-medium ">Category</label>
            <select name="category" id="category" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-600 dark:bg-zinc-600 focus:border-blue-500 focus:ring-blue-500 transition h-10">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex-1">
            <label for="name" class="block mb-2 text-sm font-medium">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-600 dark:bg-zinc-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 transition h-10"
                value="{{ $name }}"
                placeholder="Search by name..."
            />
            {{-- <flux:input name="name" label="Name" class="grow w-full mt-2" value="{{ $name }}"/> --}}
        </div>
        <div>
            {{-- in stock --}}
            <label for="in_stock" class="block mb-2 text-sm font-medium">In Stock</label>
            <input type="checkbox" id="stock" name="stock" class="w-8 h-8 text-white-600 mt-1 accent-gray-600 dark:bg-zinc-500" />

        </div>
    </div>
    <div class="flex gap-6 mt-5">
        <button type="submit" class="px-4 py-3 bg-zinc-500 dark:bg-zinc-500 hover:bg-zinc-600 text-white rounded">Filter</button>
        <a href="{{ route('products.index') }}" class="px-4 py-3 rounded bg-gray-400 text-white hover:bg-zinc-600 transition text-center dark:bg-zinc-500">Clear Filters</a>
    </div>
</form>
