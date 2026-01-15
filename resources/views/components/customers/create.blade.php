
<x-app-layout>
    <x-slot name="header" class="bg-white text-black shadow sm:rounded-lg p-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Customer
        </h2>
    </x-slot>

    <div class="py-4 mx-auto max-w-2xl mt-10">
        <div class="sm:px-6 lg:px-8 bg-white text-black shadow sm:rounded-lg p-6 rounded-lg mt-8 ">
            <form action="{{ route('customers.store') }}" method="POST">
                @include('components._form', ['buttonText' => 'Create'])
            </form>
        </div>
    </div>
</x-app-layout>
