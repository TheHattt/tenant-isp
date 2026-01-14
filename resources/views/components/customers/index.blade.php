<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Customers') }}
    </h2>
</x-slot>

<a href="{{ route('customers.create') }}" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Customer</a>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @foreach($customers as $customer)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">{{ $customer->name }}</h3>
                        <p class="text-gray-600">{{ $customer->email }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</x-app-layout>
