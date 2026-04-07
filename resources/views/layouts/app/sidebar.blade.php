<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800" x-data="{ sidebarOpen: false }">

        <!-- Mobile header -->
        <header class="flex items-center justify-between border-b border-zinc-200 bg-zinc-50 px-4 py-3 lg:hidden dark:border-zinc-700 dark:bg-zinc-900">
            <button @click="sidebarOpen = true" class="rounded-md p-1.5 text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
            <x-desktop-user-menu />
        </header>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/40 lg:hidden" @click="sidebarOpen = false"></div>

        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-e border-zinc-200 bg-zinc-50 transition-transform lg:static lg:translate-x-0 dark:border-zinc-700 dark:bg-zinc-900">

                <div class="flex h-14 items-center justify-between px-4 border-b border-zinc-200 dark:border-zinc-700">
                    <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
                    <button @click="sidebarOpen = false" class="lg:hidden rounded-md p-1 text-zinc-400 hover:text-zinc-600">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                    <p class="px-2 pb-1 text-xs font-medium text-zinc-400 uppercase tracking-wider">{{ __('Platform') }}</p>
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-zinc-200 text-zinc-900 dark:bg-zinc-700 dark:text-white' : 'text-zinc-600 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800' }}">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        {{ __('Dashboard') }}
                    </a>
                </nav>

                <div class="border-t border-zinc-200 p-3 dark:border-zinc-700">
                    <x-desktop-user-menu />
                </div>
            </aside>

            <!-- Main content -->
            <main class="flex-1 overflow-auto">
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
    </body>
</html>
