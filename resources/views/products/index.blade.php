{{-- filepath: resources/views/products/index.blade.php --}}
<x-layouts.app :title="__('Dashboard')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Products</h1>
        <x-products.filter-card :categories="$categories" :name="$name" />
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                    <!-- product card -->
                    <article class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden dark:bg-zinc-600">
                        <div>
                        <img class="object-cover h-96 w-full" src="{{ $product->photo ? asset('storage/products/' . $product->photo) : 'https://www.opelgtsource.com/assets/default_product.png' }}" alt="{{ $product->name }}" />
                        </div>

                        <div class="flex flex-col gap-1 mt-4 px-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <p class=" mb-4">{{ number_format($product->price, 2) }}€/Kg</p>
                        </div>

                        <div class="inline-flex w-full mt-4 p-4 border-t border-gray-200 dark:border-gray-500 dark:bg-zinc-500">
                            <div class="inline-flex items-center mt-2">
                                <button
                                    class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                                <div
                                    class="bg-gray-100 border-t border-b border-gray-100 text-gray-600 hover:bg-gray-100 inline-flex items-center px-4 py-1 select-none">
                                    2
                                </div>
                                <button class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>

                            <button class="inline-flex justify-end items-center font-bold cursor-pointer hover:underline text-gray-800 dark:text-gray-50 ml-auto">
                                <span class="text-base">Add to Cart</span>
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


