<aside
    :class="sidebarCollapsed ? 'w-20' : 'w-72'"
    class="hidden md:flex flex-col bg-white border-r border-slate-100 sticky top-0 h-screen transition-all duration-300 ease-in-out z-50">

    {{-- LOGO SECTION --}}
    <div class="h-20 flex items-center px-6 overflow-hidden whitespace-nowrap">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-4">
            <div class="flex-shrink-0 h-9 w-9 bg-slate-900 rounded-xl flex items-center justify-center shadow-lg shadow-slate-200">
                <x-application-logo class="h-5 w-5 fill-current text-white" />
            </div>
            <span x-show="!sidebarCollapsed" x-transition.opacity class="text-xl font-black text-slate-900 tracking-tighter">Orbix</span>
        </a>
    </div>

    {{-- LINKS --}}
    <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto custom-scrollbar">
        <p x-show="!sidebarCollapsed" class="px-4 text-[10px] font-black uppercase text-slate-400 mb-4 tracking-widest">Management</p>

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
    </nav>

    {{-- FOOTER --}}
    <div class="p-4 border-t border-slate-50 overflow-hidden">
        <div :class="sidebarCollapsed ? 'bg-transparent' : 'bg-slate-900 p-4 rounded-[24px]'" class="transition-all duration-300">
            <p x-show="!sidebarCollapsed" class="text-[10px] font-black text-slate-500 uppercase">Profile</p>
            <div class="flex items-center gap-3 mt-1">
                <div :class="sidebarCollapsed ? 'bg-slate-900' : 'bg-orange-500'" class="flex-shrink-0 h-8 w-8 rounded-xl flex items-center justify-center text-[10px] text-white font-black transition-colors">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div x-show="!sidebarCollapsed" x-transition.opacity class="min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>
