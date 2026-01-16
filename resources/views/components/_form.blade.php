<div class="space-y-8">
    {{-- 1. AVATAR UPLOAD SECTION --}}
    <div class="flex items-center gap-6 p-6 bg-slate-50 rounded-[24px] border border-slate-100/50">
        <div class="flex-shrink-0">
            @if(isset($customer) && $customer->avatar)
                <img src="{{ asset('storage/' . $customer->avatar) }}" class="h-20 w-20 object-cover rounded-[20px] shadow-sm border-4 border-white">
            @else
                <div class="h-20 w-20 bg-white flex items-center justify-center rounded-[20px] border-2 border-dashed border-slate-200 text-slate-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <div class="flex-1">
            <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Profile Picture</label>
            <input type="file" name="avatar" class="block w-full text-xs text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-xl file:border-0
                file:text-[10px] file:font-black file:uppercase
                file:bg-orange-500 file:text-white
                hover:file:bg-orange-600 transition-all cursor-pointer" />
            @error('avatar') <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- 2. INPUT FIELDS --}}
    <div class="space-y-6">
        {{-- Full Name --}}
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}"
                class="w-full border-none bg-slate-50 rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-orange-500/20 p-4 transition-all placeholder-slate-300"
                placeholder="John Doe">
            @error('name') <p class="text-red-500 text-[10px] font-bold mt-2 ml-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Email Address --}}
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}"
                    class="w-full border-none bg-slate-50 rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-orange-500/20 p-4 transition-all placeholder-slate-300"
                    placeholder="john@example.com">
                @error('email') <p class="text-red-500 text-[10px] font-bold mt-2 ml-1">{{ $message }}</p> @enderror
            </div>

            {{-- Phone Number --}}
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}"
                    class="w-full border-none bg-slate-50 rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-orange-500/20 p-4 transition-all placeholder-slate-300"
                    placeholder="+1 (555) 000-0000">
                @error('phone') <p class="text-red-500 text-[10px] font-bold mt-2 ml-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- 3. FORM ACTIONS --}}
    <div class="flex items-center justify-end gap-6 mt-10 pt-8 border-t border-slate-50">
        <a href="{{ isset($customer) ? route('customers.show', $customer) : route('customers.index') }}"
           class="text-[11px] font-black text-slate-400 uppercase hover:text-slate-600 transition-colors">
            Cancel
        </a>
        <button type="submit"
            class="px-10 py-4 bg-slate-900 text-white text-[11px] font-black uppercase rounded-[20px] shadow-xl shadow-slate-200 hover:bg-orange-600 hover:shadow-orange-200 transition-all">
            {{ isset($customer) ? 'Update Profile' : 'Create Customer' }}
        </button>
    </div>
</div>
