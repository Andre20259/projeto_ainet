@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp
<div class="flex flex-wrap space-x-8">
    <div class="grow mt-6 space-y-4">
        <flux:input name="name" label="Name" :value="$user->name" :disabled="$readonly" />
        <flux:input name="email" type="email" label="Email" :value="$user->email" :disabled="$readonly" />
        <flux:input name="type" type="Type" label="Email" :value="$user->type" :disabled="$readonly" />
        <flux:radio.group name="gender" label="Gender" :disabled="$readonly" class="flex space-x-8">
            <flux:radio value="M" label="Masculine" :checked="$user->gender == 'M'" />
            <flux:radio value="F" label="Feminine" :checked="$user->gender == 'F'" />
        </flux:radio.group>
        <flux:error name="gender" />
        @if($user->nif)
            <flux:input name="nif" label="NIF" :value="$user->nif" :disabled="$readonly" />
        @endif
        @if($user->default_delivery_address)
            <flux:input name="default_delivery_address" label="Delivery Address" :value="$user->default_delivery_address" :disabled="$readonly" />
        @endif
        @if($user->default_payment_type)
            <flux:input name="default_payment_type" label="Payment Type" :value="$user->default_payment_type" :disabled="$readonly" />
        @endif
        @if($user->default_payment_reference)
            <flux:input name="default_payment_reference" label="Payment Reference" :value="$user->default_payment_reference" :disabled="$readonly" />
        @endif
    </div>
    <div class="pb-6 pe-12">
        <x-field.image
            name="photo_file"
            label="Photo"
            width="md"
            :readonly="$readonly"
            deleteTitle="Delete Photo"
            :deleteAllow="($mode == 'edit') && ($user->photo_url)"
            deleteForm="form_to_delete_photo"
            :imageUrl="$user->photoFullUrl"/>          

    </div>
</div>
