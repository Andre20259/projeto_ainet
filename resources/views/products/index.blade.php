{{-- filepath: resources/views/products/index.blade.php --}}
<x-layouts.app :title="__('Product List')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Products</h1>
        <x-products.filter-table-card :categories="$categories" :name="$name" />

        <x-products.table :products="$products"
            :showView=True
            :showEdit=True
            :showDelete=True
        />

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>
