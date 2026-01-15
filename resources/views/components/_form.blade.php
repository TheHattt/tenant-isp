@csrf

@if(isset($customer) && $customer->id)
    @method('PUT')
@endif

@csrf

@if(isset($customer) && $customer->id)
    @method('PUT')
@endif

<div class="max-w-2xl mx-auto p-6 rounded-lg mt-8">  <!-- Added: bg-red-500 p-6 rounded -->
    <!-- Name Field -->
    <div class="mb-4">
        <label for="name" class="block text-black font-medium mb-2">
            Name <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $customer->name ?? '') }}"
            class="w-full px-4 py-2 text-black border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror"
        >
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email Field -->
    <div class="mb-4">
        <label for="email" class="block text-black font-medium mb-2">
            Email <span class="text-red-500">*</span>
        </label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $customer->email ?? '') }}"
            class="w-full px-4 py-2 text-black border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('email') border-red-500 @enderror"
        >
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Phone Field -->
    <div class="mb-6">
        <label for="phone" class="block text-black font-medium mb-2">
            Phone <span class="text-red-500">*</span>
        </label>
        <input
            type="tel"
            id="phone"
            name="phone"
            value="{{ old('phone', $customer->phone ?? '') }}"
            class="w-full px-4 py-2 text-black border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
        >
        @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Form Actions -->
    <div class="flex justify-end space-x-3">
        <a
            href="{{ route('customers.index') }}"
            class="px-5 py-2 text-black border border-gray-300 rounded hover:bg-gray-50"
        >
            Cancel
        </a>
        <button
            type="submit"
            class="px-5 py-2 bg-blue-600 text-black rounded hover:bg-blue-700"
        >
            {{ $buttonText }}
        </button>
    </div>
</div>
