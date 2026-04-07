<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800" x-data="{ mobileMenuOpen: false }">

        <header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <div class="mx-auto flex h-14 max-w-screen-xl items-center gap-4 px-4">
                <!-- Mobile toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden rounded-md p-1.5 text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

                <!-- Desktop nav -->
                <nav class="hidden lg:flex items-center gap-1 border-b-0 flex-1">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-zinc-900 dark:text-white' : 'text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white' }}">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        {{ __('Dashboard') }}
                    </a>
                </nav>

                <div class="ml-auto">
                    <x-desktop-user-menu />
                </div>
            </div>

            <!-- Mobile nav -->
            <div x-show="mobileMenuOpen" x-transition class="lg:hidden border-t border-zinc-200 px-4 py-2 dark:border-zinc-700">
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    {{ __('Dashboard') }}
                </a>
            </div>
        </header>

        {{ $slot }}

        @livewireScripts
    </body>
</html>
