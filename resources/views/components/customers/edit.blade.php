
{{-- resources/views/customers/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Customer
        </h2>
    </x-slot>

    <div class="py-4 mx-auto max-w-xl mt-10">
        <div class="sm:px-6 lg:px-8 bg-white text-black shadow sm:rounded-lg p-6">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PATCH')
                @include('components._form', ['buttonText' => 'update', 'customer' => $customer])
            </form>
        </div>
    </div>
</x-app-layout>
