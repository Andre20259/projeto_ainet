@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Card Details</h1>
    <flux:button variant="primary" href="{{ route('card.load') }}" > Load Card </flux:button>
</div>

<flux:input name="name" label="Name" value="{{ old('name', $card->user->name) }}" :disabled="$readonly" />

<div class="flex flex-row sm:flex-row sm space-x-4">
    <div class="w-full">
        <flux:input name="number" label="Card Number" value="{{ old('number', $card->card_number) }}" :disabled="$readonly" />
    </div>
    <div class="w-full">
        <flux:input name="balance" label="Balance" value="{{ old('balance', $card->balance) }}" :disabled="$readonly" />
    </div>
</div>

<h2 class="text-xl font-semibold mt-6 mb-2">Operations</h2>

<table class="w-full table-auto border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">Date</th>
            <th class="border border-gray-300 px-4 py-2">Type</th>
            <th class="border border-gray-300 px-4 py-2">Value (€)</th>
            <th class="border border-gray-300 px-4 py-2">Subtype</th>
            <th class="border border-gray-300 px-4 py-2">Payment Type</th>
            <th class="border border-gray-300 px-4 py-2">Payment Reference</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($card->operations as $operation)
            <tr>
                <td class="border px-4 py-2">{{ $operation->date }}</td>
                <td class="border px-4 py-2 capitalize">{{ $operation->type }}</td>
                <td class="border px-4 py-2">{{ number_format($operation->value, 2) }}</td>
                <td class="border px-4 py-2">
                    @if ($operation->type === 'credit')
                        {{ $operation->credit_type ?? '-' }}
                    @else
                        {{ $operation->debit_type ?? '-' }}
                    @endif
                    <!-- {{ $operation->type === 'credit' ? $operation->credit_type : $operation->debit_type }} -->
                </td>
                <td class="border px-4 py-2">
                    {{ $operation->payment_type ?? '-' }}
                </td>
                <td class="border px-4 py-2">
                    {{ $operation->payment_reference ?? '-' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 py-4">Without operations.</td>
            </tr>
        @endforelse
    </tbody>
</table>

