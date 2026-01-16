<nav x-data="{ mobileMenuOpen: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center gap-4">
                {{-- DESKTOP COLLAPSE TOGGLE --}}
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden md:flex p-2 rounded-xl text-slate-400 hover:bg-slate-50 hover:text-orange-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </button>

                {{-- Breadcrumbs --}}
                <div class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider">
                    <span class="text-slate-400">Workspace</span>
                    <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-slate-900">
                        @if(request()->routeIs('dashboard')) Dashboard
                        @elseif(request()->routeIs('customers.*')) Customer Directory
                        @else Active Session @endif
                    </span>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-slate-100 text-sm font-bold rounded-2xl text-slate-500 bg-white hover:text-orange-500 hover:border-orange-100 transition duration-150">
                            <div class="flex items-center gap-3">
                                <div class="h-6 w-6 rounded-lg bg-slate-900 text-[10px] text-white flex items-center justify-center font-black">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>{{ Auth::user()->name }}</div>
                            </div>
                            <svg class="ms-2 fill-current h-4 w-4 text-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile Settings') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="text-red-500">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Mobile Logo & Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden justify-between w-full">
                <x-application-logo class="block h-8 w-auto fill-current text-slate-900" />
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-xl text-slate-400">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-cloak class="sm:hidden bg-white border-t border-slate-50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">Directory</x-responsive-nav-link>
        </div>
    </div>
</nav>
