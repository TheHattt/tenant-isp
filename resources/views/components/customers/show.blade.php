<x-app-layout>
    <div class="text-right w-full mx-auto max-w-2xl mt-8">
       <a href="{{ route('customers.index') }}" class="text-blue-500 text-2xl font-bold hover:text-blue-700">Back</a>
    </div>
    <div class="bg-white p-10 mt-8 rounded shadow w-full max-w-2xl mx-auto ">
        <div class=" px-10">
            <div class="flex flex-col gap-8">
                    <h1 class="text-2xl font-bold bg-gray-50 px-4 py-2">{{ $customer->name }}</h1>
                <p class="text-lg bg-gray-50 px-4 py-2">{{ $customer->email }}</p>
                <p class="text-lg bg-gray-50 px-4 py-2">{{ $customer->phone }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
