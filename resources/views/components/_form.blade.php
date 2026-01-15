{{-- resources/views/components/_form.blade.php --}}
<div class="space-y-6">
    <div class="mb-8 pb-4 border-b border-gray-100">
        <h3 class="text-sm font-bold uppercase tracking-widest text-indigo-600">
            {{ isset($customer->id) ? 'Update Profile' : 'Create Customer' }}
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ isset($customer->id)
                ? "You are currently modifying the record for {$customer->name}."
                : "Enter the details below to add a new customer to your directory."
            }}
        </p>
    </div>

    <div>
        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Full Name</label>
        <input type="text" name="name" id="name"
            value="{{ old('name', $customer->name ?? '') }}"
            placeholder="e.g. John Doe"
            class="w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm transition @error('name') border-red-500 @enderror"
            required>
        @error('name')
            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Email Address</label>
        <input type="email" name="email" id="email"
            value="{{ old('email', $customer->email ?? '') }}"
            placeholder="john@example.com"
            class="w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm transition @error('email') border-red-500 @enderror"
            required>
        @error('email')
            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Phone Number</label>
        <input type="text" name="phone" id="phone"
            value="{{ old('phone', $customer->phone ?? '') }}"
            placeholder="+1 (555) 000-0000"
            class="w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm transition @error('phone') border-red-500 @enderror">
        @error('phone')
            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
        <a href="{{ route('customers.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-md text-xs font-bold uppercase tracking-widest text-gray-600 hover:bg-gray-50 transition shadow-sm">
            Cancel
        </a>

        <button type="submit"
            class="px-6 py-2 bg-indigo-600 border border-transparent rounded-md text-xs font-bold uppercase tracking-widest text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-md transition">
            {{ $buttonText ?? 'Save Customer' }}
        </button>
    </div>
</div>
