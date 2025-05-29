<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Store')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Home') }}</flux:navlist.item>
                    <flux:navlist.item icon="tag" :href="route('products.showcase')" :current="request()->routeIs('products.showcase')" wire:navigate>{{ __('Products') }}</flux:navlist.item>
                    <flux:navlist.item
                        icon="shopping-cart"
                        :href="route('cart.show')"
                        :current="request()->routeIs('cart.show')"
                        wire:navigate
                    >
                        <div class="flex w-full justify-between items-center">
                            <span>{{ __('Cart') }}</span>

                            @php
                                $cartCount = session('cart') ? count(session('cart')) : 0;
                            @endphp

                            @if($cartCount > 0)
                                <span class="inline-flex items-center px-1.5 py-0.5 text-sm font-bold leading-none text-white bg-red-700 rounded-full ml-2">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </div>
                    </flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-list" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Orders') }}</flux:navlist.item>

                </flux:navlist.group>
            </flux:navlist>


            {{-- This is only for Admins and employes --}}
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Management')" class="grid">
                    {{-- to be changed for the correct route --}}
                    <flux:navlist.item icon="users" :href="route('products.index')" :current="request()->routeIs('products.index')" wire:navigate>{{ __('Users') }}</flux:navlist.item>
                    <flux:navlist.item icon="tag" :href="route('products.index')" :current="request()->routeIs('products.index')" wire:navigate>{{ __('Products') }}</flux:navlist.item>
                    <flux:navlist.item icon="briefcase" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Employees') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />


            <flux:navlist variant="outline">
                 <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                    <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                </flux:radio.group>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    :avatar="auth()->user()->getPhotoFullUrlAttribute()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    @if(auth()->user()->photo)
                                        <img src="{{ auth()->user()->getPhotoFullUrlAttribute() }}"
                                            alt="Profile Photo"
                                            class="object-cover w-full h-full rounded-lg" />
                                    @else
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                        >
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    @endif
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->getPhotoFullUrlAttribute() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
