<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Hi, {{ Auth::user()->name }}!</h3>
                <p class="text-black/80 font-medium">Here's what's happening with your business today.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Customers</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ \App\Models\Customer::count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">New This Month</p>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\Customer::whereMonth('created_at', now()->month)->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Active Projects</p>
                    <p class="text-3xl font-bold text-orange-500">--</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-slate-600 mb-4">Quick Actions</h4>
                        <div class="grid grid-cols-1 gap-4">

                            @can('create', App\Models\Customer::class)
                            <a href="{{ route('customers.create') }}" class="group flex items-center justify-between p-4 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition">
                                <div class="flex items-center">
                                    <div class="p-2 bg-indigo-500 rounded-lg text-white mr-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-indigo-900">Add Customer</h5>
                                        <p class="text-sm text-indigo-700">Onboard a new client</p>
                                    </div>
                                </div>
                                <span class="text-indigo-400 group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                            @endcan

                            <a href="{{ route('customers.index') }}" class="group flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition border border-gray-200">
                                <div class="flex items-center">
                                    <div class="p-2 bg-gray-500 rounded-lg text-white mr-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900">Directory</h5>
                                        <p class="text-sm text-gray-600">Manage your existing database</p>
                                    </div>
                                </div>
                                <span class="text-gray-400 group-hover:translate-x-1 transition-transform">→</span>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-200">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Recent Customers</h4>
                    <div class="divide-y divide-gray-100">
                        @php $recentCustomers = \App\Models\Customer::latest()->take(5)->get(); @endphp
                        @forelse($recentCustomers as $recent)
                            <div class="py-3 flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">{{ $recent->name }}</span>
                                <span class="text-xs text-gray-400">{{ $recent->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 py-4">No recent activity.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
