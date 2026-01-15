
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customers
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 text-right mt-8">
                @can('create', App\Models\Customer::class)
                    <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                        Create Customer
                    </a>
                @endcan
            </div>

            <div class="bg-white text-black shadow overflow-hidden sm:rounded-lg mt-8 p-20">
                <table class="min-w-full divide-y divide-gray-100 ">
                    <thead class="bg-gray-50 text-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customers as $customer)
                            <tr class="hover:bg-gray-100 cursor-pointer transition duration-300 ease-in-out" onclick="window.location.href = '{{ route('customers.show', $customer) }}'">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->phone ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @can('update', $customer)
                                        <a href="{{ route('customers.edit', $customer) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    @endcan
                                    @can('delete', $customer)
                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline px-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
