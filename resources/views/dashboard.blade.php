<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome Header --}}
            <div class="mb-10">
                <div class="flex items-center gap-2 mb-1">
                    <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                    <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Intelligence Briefing</span>
                </div>
                <h1 class="text-4xl font-semibold text-slate-900 tracking-tight">
                    Hi, {{ Auth::user()->name }}!
                </h1>
                <p class="text-sm font-bold text-slate-600 mt-1">Here's a breakdown of your business operations today.</p>
            </div>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[24px] border border-slate-100 shadow-sm group hover:border-orange-200 transition-colors">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase ">Total Customers</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-4xl font-bold text-slate-900">{{ \App\Models\Customer::count() }}</p>
                        <div class="h-8 w-8 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[24px] border border-slate-100 shadow-sm group hover:border-orange-200 transition-colors">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase">New This Month</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-4xl font-black text-slate-900">{{ \App\Models\Customer::whereMonth('created_at', now()->month)->count() }}</p>
                        <div class="h-8 w-8 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[24px] border border-slate-100 shadow-sm group hover:border-orange-200 transition-colors">
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Active Projects</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-4xl font-bold text-slate-900">--</p>
                        <div class="h-8 w-8 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Quick Actions --}}
                <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden p-8">
                    <h4 class="text-[10px] font-bold text-slate-500 uppercase mb-6">Command Center</h4>
                    <div class="grid grid-cols-1 gap-4">
                        @can('create', App\Models\Customer::class)
                        <a href="{{ route('customers.create') }}" class="flex items-center justify-between p-5 bg-white border border-slate-100 rounded-2xl hover:border-orange-200 hover:shadow-lg hover:shadow-orange-50 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-orange-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-100 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                                </div>
                                <div>
                                    <h5 class="text-sm font-black text-slate-900 uppercase tracking-normal">Add New Customer</h5>
                                    <p class="text-xs font-bold text-slate-400 mt-0.5">Initialize a new client record</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-200 group-hover:text-orange-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endcan

                        <a href="{{ route('customers.index') }}" class="flex items-center justify-between p-5 bg-white border border-slate-100 rounded-2xl hover:border-slate-900 hover:shadow-lg hover:shadow-slate-50 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-slate-900 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h7"></path></svg>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold text-slate-900 uppercase tracking-normal">View Directory</h5>
                                    <p class="text-xs font-bold text-slate-400 mt-0.5">Access the full database</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-200 group-hover:text-slate-900 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Recent Activity --}}
                <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-8">
                    <h4 class="text-[14px] font-black text-slate-400 tracking-normal mb-6">Recent Additions</h4>
                    <div class="space-y-4">
                        @php $recentCustomers = \App\Models\Customer::latest()->take(5)->get(); @endphp
                        @forelse($recentCustomers as $recent)
                            <div class="flex items-center justify-between p-4 bg-slate-50/50 rounded-2xl group hover:bg-orange-50/50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 bg-white border border-slate-100 rounded-lg flex items-center justify-center text-[10px] font-bold text-slate-700 uppercase">
                                        {{ substr($recent->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700">{{ $recent->name }}</span>
                                </div>
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">{{ $recent->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="py-10 text-center">
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest">No Recent Activity</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
