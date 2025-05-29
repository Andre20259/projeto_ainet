<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <x.layouts.main-content :title="$title ?? null" :heading="$heading ?? null" :subheading="$subheading ?? null">
            {{ $slot }}
        </x.layouts.main-content>
    </flux:main>
</x-layouts.app.sidebar>
