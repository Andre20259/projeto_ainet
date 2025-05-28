{{-- filepath: resources/views/products/index.blade.php --}}
<x-layouts.app :title="__('Dashboard')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Products</h1>
        <x-products.filter-card :categories="$categories" />
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)

                    <!-- product card -->
                    <article class="max-w-sm w-full bg-white rounded-lg shadow-lg overflow-hidden dark:bg-gray-700">
                        <div>
                        <img class="object-cover h-64 w-full" src="{{ $product->photo ? asset('storage/products/' . $product->photo) : 'https://www.opelgtsource.com/assets/default_product.png' }}" alt="{{ $product->name }}" />
                        </div>

                        <div class="flex flex-col gap-1 mt-4 px-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <p class=" mb-4">${{ number_format($product->price, 2) }}</p>
                        </div>

                        <div class="mt-4 p-4 border-t border-gray-200 dark:border-gray-500">
                            <button class="w-full flex justify-between items-center font-bold cursor-pointer hover:underline text-gray-800 dark:text-gray-50">
                                <span class="text-base">Add to Cart</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                        </div>
                    </article>

            @endforeach
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>




