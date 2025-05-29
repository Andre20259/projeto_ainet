<x-layouts.app :title="__('Home')">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- info --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <flux:button
                variant="primary"
                class="h-full w-full flex flex-col items-center justify-center space-y-2 bg-gray-50 text-gray-800 hover:bg-gray-50 dark:bg-neutral-600 dark:text-neutral-200 dark:hover:bg-neutral-600"

            >
                <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/4437/4437654.png') }}" alt="Logo" class="size-50" />
                <p class="text-3xl font-semibold">Grocery Club</p>
                <p class="text-2xl">Shopping made easy</p>

            </flux:button>
        </div>
        {{-- Products --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <flux:button
                variant="primary"
                class="h-full w-full flex flex-col items-center justify-center space-y-2 bg-gray-50 text-gray-800 hover:bg-gray-100 dark:bg-neutral-600 dark:text-neutral-200 dark:hover:bg-neutral-800"
                href="{{ route('products.showcase') }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 md:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                <p class="text-3xl font-semibold">Products</p>
            </flux:button>
        </div>

        {{-- Cart --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <flux:button
                variant="primary"
                class="h-full w-full flex flex-col items-center justify-center space-y-2 bg-gray-50 text-gray-800 hover:bg-gray-100 dark:bg-neutral-600 dark:text-neutral-200 dark:hover:bg-neutral-800"
                href="{{ route('cart.show') }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <p class="text-3xl font-semibold">Cart</p>
            </flux:button>
        </div>

        {{-- Orders --}}
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <flux:button
                variant="primary"
                class="h-full w-full flex flex-col items-center justify-center space-y-2 bg-gray-50 text-gray-800 hover:bg-gray-100 dark:bg-neutral-600 dark:text-neutral-200 dark:hover:bg-neutral-800"
                href="{{ route('dashboard') }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                <p class="text-3xl font-semibold">Orders</p>
            </flux:button>
        </div>

        {{-- (Optional) Add a 4th card or leave the grid with 3 items --}}
    </div>
</x-layouts.app>
