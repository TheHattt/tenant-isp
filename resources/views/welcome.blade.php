<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'CRM System') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex flex-col p-6 lg:p-8 items-center lg:justify-center font-sans">

        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] rounded-sm transition text-[#1b1b18]">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-1.5 text-[#706f6c] hover:text-[#1b1b18] transition">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-1.5 bg-[#1b1b18] text-white rounded-sm font-medium hover:bg-black transition shadow-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
            <main class="flex max-w-[335px] w-full flex-col lg:max-w-4xl lg:flex-row bg-white shadow-sm border border-[#e3e3e0] rounded-lg overflow-hidden">

                <div class="flex-1 p-8 lg:p-20">
                    <div class="mb-10">
                        <h1 class="text-2xl font-medium mb-3">Customer Management</h1>
                        <p class="text-[#706f6c] leading-relaxed">
                            Welcome to your workspace. Organize your client data, track business growth, and manage relationships with a clean, focused interface.
                        </p>
                    </div>

                    <ul class="flex flex-col space-y-2">
                        <li class="flex items-center gap-4 py-2 relative">
                            <div class="h-1.5 w-1.5 rounded-full bg-[#dbdbd7]"></div>
                            <span class="text-sm text-[#706f6c]">Cloud-based Multi-tenancy</span>
                        </li>
                        <li class="flex items-center gap-4 py-2 relative">
                            <div class="h-1.5 w-1.5 rounded-full bg-[#dbdbd7]"></div>
                            <span class="text-sm text-[#706f6c]">Secure Authentication</span>
                        </li>
                        <li class="flex items-center gap-4 py-2 relative">
                            <div class="h-1.5 w-1.5 rounded-full bg-[#dbdbd7]"></div>
                            <span class="text-sm text-[#706f6c]">Real-time Search Filters</span>
                        </li>
                    </ul>

                    <div class="mt-10">
                        <a href="{{ route('customers.index') }}" class="text-sm font-medium text-[#1b1b18] underline underline-offset-4 hover:text-black">
                            Go to Customers &rarr;
                        </a>
                    </div>
                </div>

                <div class="flex-1 p-8 lg:p-20 bg-[#FDFDFC] border-t lg:border-t-0 lg:border-l border-[#e3e3e0]">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="p-5 bg-white border border-[#e3e3e0] rounded shadow-[0px_1px_2px_0px_rgba(0,0,0,0.06)]">
                            <h4 class="font-medium text-sm mb-1 text-gray-900">Documentation</h4>
                            <p class="text-xs text-gray-500">Learn how to customize your CRM portal.</p>
                        </div>

                        <div class="p-5 bg-white border border-[#e3e3e0] rounded shadow-[0px_1px_2px_0px_rgba(0,0,0,0.06)]">
                            <h4 class="font-medium text-sm mb-1 text-gray-900">Advanced API</h4>
                            <p class="text-xs text-gray-500">Connect your customer data to other tools.</p>
                        </div>
                    </div>

                    <div class="mt-12">
                        <p class="text-[11px] text-[#A1A09A] uppercase tracking-widest">
                            System Status: <span class="text-green-600 font-bold">Operational</span>
                        </p>
                    </div>
                </div>
            </main>
        </div>

        <footer class="mt-8 py-4 text-center">
            <p class="text-xs text-[#A1A09A]">
                Built with Laravel 12.0 &bull; {{ date('Y') }}
            </p>
        </footer>
    </body>
</html>
