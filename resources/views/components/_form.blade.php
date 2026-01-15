{{-- resources/views/customers/_form.blade.php --}}
<div class="space-y-6">
    <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-xl border border-gray-100">
        <div class="flex-shrink-0">
            @if(isset($customer) && $customer->avatar)
                <img src="{{ asset('storage/' . $customer->avatar) }}" class="h-20 w-20 object-cover rounded-2xl shadow-sm border-2 border-white">
            @else
                <div class="h-20 w-20 bg-indigo-100 flex items-center justify-center rounded-2xl border-2 border-dashed border-indigo-200 text-indigo-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            @endif
        </div>

        <div class="flex-1">
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Profile Picture</label>
            <input type="file" name="avatar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:uppercase file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition" />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" class="w-full border-gray-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 bg-white" required>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Email Address</label>
            <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" class="w-full border-gray-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 bg-white" required>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" class="w-full border-gray-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 bg-white">
        </div>
    </div>

    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
        <a href="{{ isset($customer) ? route('customers.show', $customer) : route('customers.index') }}" class="px-6 py-2.5 text-sm font-bold text-gray-400 uppercase tracking-widest hover:text-gray-600 transition">
            Cancel
        </a>
        <button type="submit" class="px-8 py-2.5 bg-gray-900 text-white text-xs font-bold uppercase tracking-widest rounded-lg shadow-lg hover:bg-black transition">
            {{ isset($customer) ? 'Update Profile' : 'Create Customer' }}
        </button>
    </div>
</div>
