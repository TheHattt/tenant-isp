<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-8">
        <h1 class="text-2xl font-bold text-gray-700">
            Welcome back, {{ Auth::user()->name }}
        </h1>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Alert --}}
            @if(session('success'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 3000)"
                     class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm flex justify-between">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false">&times;</button>
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                @can('create', App\Models\Customer::class)
                    <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-sm">
                        Add Customer
                    </a>
                @endcan

                <form action="{{ route('customers.index') }}" method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <input
                            type="text"
                            name="filter[search]"
                            value="{{ request('filter.search') }}"
                            placeholder="Search name, email or phone..."
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        >
                        @if(request()->filled('filter.search'))
                            <a href="{{ route('customers.index') }}" class="absolute right-3 top-2 text-gray-400 hover:text-gray-600 text-xl">
                                &times;
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Table Container --}}
            <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customers as $customer)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                    <a href="{{ route('customers.show', $customer) }}" class="hover:underline">{{ $customer->name }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $customer->email ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $customer->phone ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-4">
                                        @can('update', $customer)
                                            <a href="{{ route('customers.edit', $customer) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        @endcan

                                        @can('delete', $customer)
                                            <button
                                                type="button"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-customer-deletion'); $dispatch('set-deletion-target', { action: '{{ route('customers.destroy', $customer) }}', name: '{{ $customer->name }}' })"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                    No customers found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($customers->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $customers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-modal name="confirm-customer-deletion" focusable>
        <div
            x-data="{ action: '', name: '' }"
            x-on:set-deletion-target.window="action = $event.detail.action; name = $event.detail.name"
            class="p-6"
        >
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete <span x-text="name" class="font-bold text-red-600"></span>?
            </h2>

            <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                This action cannot be undone. All data associated with this customer will be permanently removed from our servers.
            </p>

            <form method="post" :action="action" class="mt-6 flex justify-end gap-3">
                @csrf
                @method('delete')

                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Customer') }}
                </x-danger-button>
            </form>
        </div>
    </x-modal>

</x-app-layout>
