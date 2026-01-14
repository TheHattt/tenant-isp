<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-8 items-center">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    <a href="{{ route('customers.index') }}" class="btn btn-primary">{{ __('Customers') }}</a>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 bg-blue-700 text-white/5 rounded">Create Customer</button>
    </form>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
