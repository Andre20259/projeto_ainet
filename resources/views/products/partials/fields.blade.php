@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp
<div class="grid grid-cols-2">
    <div>
        <div>
            <x-flux::input
                name="name"
                label="{{ __('Name') }}"
                :value="$product->name ?? ''"
                :readonly="$readonly"
                required
            />
        </div>

        <div class="mt-5">
            <x-flux::input
                name="price"
                type="number"
                label="{{ __('Price') }}"
                :value="$product->price ?? ''"
                :readonly="$readonly"
                required
            />
        </div>

        <div class="mt-5">
            <x-flux::input
                name="stock"
                type="number"
                label="{{ __('Initial Stock') }}"
                :value="$product->price ?? ''"
                :readonly="$readonly"
                required
            />
        </div>

        <div class="mt-5">
            <x-flux::input
                name="stock"
                type="number"
                label="{{ __('Discount') }}"
                :value="$product->price ?? ''"
                :readonly="$readonly"
                required
            />
        </div>

        <div>
            <flux:select name="category_id" label="Category" :disabled="$readonly">
                 @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </flux:select>
        </div>

        <div class="mt-5">
            <x-flux::textarea
                name="description"
                label="{{ __('Description') }}"
                :value="$product->description ?? ''"
                :readonly="$readonly"
            />
        </div>

        {{-- <div>
            <x-flux::file-input
                name="image"
                label="{{ __('Product Image') }}"
                :value="$product->image ?? ''"
                :disabled="$readonly"
            />
        </div> --}}

        <div class="mt-5">
            <flux:button
                type="submit"
                variant="primary"
                :disabled="$readonly"
                class="w-full"
            >
                {{ $mode == 'edit' ? __('Save') : __('Update') }}
            </flux:button>
        </div>
    </div>
    <div class="mb-auto ml-20">
        <div class="pb-6 pe-12">
            <x-field.image
                name="photo_file"
                label="Photo"
                width="md"
                :readonly="$readonly"
                deleteTitle="Delete Photo"
                :deleteAllow="true"
                :imageUrl="$product->photo"/>
        </div>
    </div>

</div>


