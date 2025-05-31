<x-layouts.main-content title="New product"
                        heading="Add a new product"
                        subheading='Click on "Save" button to store the information.'>
    <div class="flex flex-col space-y-6">
        <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
            @csrf
            @include('products.partials.fields', ['mode' => 'edit'])

        </form>
    </div>
</x-layouts.main-content>
