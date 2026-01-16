<aside
    :class="sidebarCollapsed ? 'w-20' : 'w-72'"
    class="hidden md:flex flex-col bg-white border-r border-slate-100 sticky top-0 h-screen transition-all duration-300 ease-in-out z-50">

    {{-- LOGO SECTION --}}
    <div class="h-20 flex items-center px-6 overflow-hidden whitespace-nowrap">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="flex-shrink-0 h-9 w-9 bg-slate-900 rounded-xl flex items-center justify-center shadow-lg shadow-slate-200">
                <x-application-logo class="h-5 w-5 fill-current text-white" />
            </div>
            <span x-show="!sidebarCollapsed" x-transition.opacity class="text-xl font-bold text-slate-600 ">Orbix Studio</span>
        </a>
    </div>

    {{-- LINKS --}}
    <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto custom-scrollbar">
        <p x-show="!sidebarCollapsed" class="px-4 text-[16px] font-bold  text-slate-600 mb-4">
            Welcome, {{ Auth::user()->name }}
        </p>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-2xl text-sm font-bold transition-all group {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
            <svg class="flex-shrink-0 w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
            <span x-show="!sidebarCollapsed" x-transition.opacity class="whitespace-nowrap">Dashboard</span>
        </a>

        {{-- Customers --}}
        <a href="{{ route('customers.index') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-2xl text-sm font-bold transition-all group {{ request()->routeIs('customers.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
            <svg class="flex-shrink-0 w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            <span x-show="!sidebarCollapsed" x-transition.opacity class="whitespace-nowrap">Customers</span>
        </a>

        {{-- Projects --}}

        <a href="{{ route('projects.index') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-2xl text-sm font-bold transition-all group {{ request()->routeIs('projects.*') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

            <svg class="w-6 h-6 text-gray-800 dark:text-gray-600 shrink-0 transition-transform group-hover:scale-110" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
            </svg>
            <span x-show="!sidebarCollapsed" x-transition.opacity class="whitespace-nowrap">Projects</span>
        </a>

    </nav>
   </aside>
