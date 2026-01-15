{{-- resources/views/customers/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Customer') }}
            </h2>
            <a href="{{ route('customers.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition">
                &larr; Back to Directory
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    {{-- Form for creating a new record --}}
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        {{-- Include the shared form component --}}
                        @include('components._form', [
                            'buttonText' => 'Create Customer',
                            'customer' => null {{-- Passing null because we don't have an ID yet --}}
                        ])
                    </form>
                </div>
            </div>

            {{-- Optional Footer Tip --}}
            <div class="mt-6 flex items-center gap-2 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-xs italic underline decoration-gray-200 decoration-2 underline-offset-4">
                    Once created, you can add internal notes and contact logs from the customer's profile page.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
