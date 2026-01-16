<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-color: #F8FAFC;
                letter-spacing: normal !important;
            }
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #CBD5E1; }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-900 bg-[#F8FAFC]">
        {{-- ALPINE STATE DEFINED HERE --}}
        <div x-data="{ sidebarCollapsed: false }" class="flex min-h-screen">

            {{-- 1. THE SIDEBAR --}}
            @include('layouts.sidebar')

            {{-- 2. MAIN CONTENT AREA --}}
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                {{-- Global Top Bar --}}
                @include('layouts.navigation')

                <main class="flex-1 overflow-y-auto custom-scrollbar">
                    @isset($header)
                        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                            <div class="text-2xl font-black text-slate-900 tracking-tight">
                                {{ $header }}
                            </div>
                        </div>
                    @endisset

                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
