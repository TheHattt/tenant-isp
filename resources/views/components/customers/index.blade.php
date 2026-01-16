
<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header: Pure White & Orange --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                        Customer Directory
                    </h1>
                    <p class="text-sm font-bold text-slate-400 mt-1">
                        Total Clients: <span class="text-orange-500">{{ $customers->count() }}</span>
                    </p>
                </div>

                @can('create', App\Models\Customer::class)
                    <a href="{{ route('customers.create') }}" class="inline-flex items-center px-6 py-3 bg-orange-500 rounded-2xl font-black text-[11px] text-white uppercase tracking-widest hover:bg-orange-600 transition shadow-lg shadow-orange-100">
                        <svg class="w-4 h-4 mr-2 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                        Add Customer
                    </a>
                @endcan
            </div>

            {{-- Search: Simple & White --}}
            <div class="mb-6">
                <form action="{{ route('customers.index') }}" method="GET" class="max-w-md">
                    <div class="relative group">
                        <input
                            type="text"
                            name="filter[search]"
                            value="{{ request('filter.search') }}"
                            placeholder="Search directory..."
                            class="w-full bg-white border border-slate-200 rounded-2xl py-3 pl-11 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all placeholder-slate-300"
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-300 group-focus-within:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Table: Clean White with Orange Accents --}}
            <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Customer</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Contact</th>
                            <th class="px-8 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($customers as $customer)
                            <tr class="hover:bg-orange-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 font-black text-xs">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('customers.show', $customer) }}" class="text-sm font-black text-slate-900 hover:text-orange-500 transition-colors">
                                                {{ $customer->name }}
                                            </a>
                                            <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter">Client Profile</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-slate-600">{{ $customer->email }}</div>
                                    <div class="text-[10px] font-black text-slate-300 mt-1">{{ $customer->phone ?? 'NO PHONE' }}</div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        {{-- Actions are Back and Visible --}}
                                        @can('update', $customer)
                                            <a href="{{ route('customers.edit', $customer) }}" class="p-2 text-slate-300 hover:text-orange-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            </a>
                                        @endcan

                                        @can('delete', $customer)
                                            <button
                                                type="button"
                                                @click="$dispatch('open-modal', 'confirm-customer-deletion'); $dispatch('set-deletion-target', { action: '{{ route('customers.destroy', $customer) }}', name: '{{ $customer->name }}' })"
                                                class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center">
                                    <p class="text-xs font-black text-slate-300 uppercase tracking-widest">No customers found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($customers->hasPages())
                    <div class="px-8 py-4 bg-slate-50 border-t border-slate-100">
                        {{ $customers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Simplified Deletion Modal --}}
    <x-modal name="confirm-customer-deletion" focusable>
        <div x-data="{ action: '', name: '' }" x-on:set-deletion-target.window="action = $event.detail.action; name = $event.detail.name" class="p-8">
            <h2 class="text-xl font-black text-slate-900">Delete <span x-text="name" class="text-orange-500"></span>?</h2>
            <p class="mt-2 text-sm font-bold text-slate-400">This action is permanent and cannot be undone.</p>

            <form method="post" :action="action" class="mt-8 flex justify-end gap-3">
                @csrf @method('delete')
                <button type="button" x-on:click="$dispatch('close')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600">Cancel</button>
                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition shadow-lg shadow-red-100">Delete Profile</button>
            </form>
        </div>
    </x-modal>
</x-app-layout>
