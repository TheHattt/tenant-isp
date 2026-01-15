{{-- resources/views/customers/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Customer Profile') }}
            </h2>
            <a href="{{ route('customers.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition">
                &larr; Back to Directory
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Success Notification --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                     class="bg-green-50 border-l-4 border-green-400 p-4 shadow-sm rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-8">
                        {{-- Avatar Logic: Shows Image or Initial --}}
                        <div class="flex-shrink-0">
                            @if($customer->avatar)
                                <img src="{{ asset('storage/' . $customer->avatar) }}?v={{ time() }}"
                                     class="h-28 w-28 object-cover rounded-3xl shadow-lg border-4 border-white ring-1 ring-gray-100">
                            @else
                                <div class="h-28 w-28 bg-indigo-600 flex items-center justify-center rounded-3xl text-white text-4xl font-bold shadow-lg shadow-indigo-100">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $customer->name }}</h1>
                            <div class="flex flex-wrap items-center gap-y-2 gap-x-6 mt-3">
                                <div class="flex items-center text-gray-500 gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm">{{ $customer->email }}</span>
                                </div>
                                <div class="flex items-center text-gray-500 gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <span class="text-sm">{{ $customer->phone ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-lg text-xs font-bold uppercase tracking-widest text-gray-700 hover:bg-gray-50 transition shadow-sm">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-8 flex flex-col">
                    <h3 class="font-bold text-gray-400 mb-6 uppercase text-xs tracking-[0.2em]">Communication Log</h3>

                    <form action="{{ route('customers.notes.store', $customer) }}" method="POST" class="mb-8">
                        @csrf
                        <textarea name="body" rows="3" class="w-full border-gray-200 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 bg-gray-50/50" placeholder="Type a note about your last interaction..."></textarea>
                        <button class="mt-3 w-full bg-gray-900 text-white text-xs py-3 rounded-lg uppercase font-bold tracking-widest hover:bg-black transition shadow-lg">
                            Add Note
                        </button>
                    </form>

                    <div class="space-y-4 overflow-y-auto max-h-[500px] pr-4">
                        @forelse($customer->notes()->latest()->get() as $note)
                            <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm relative group">
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $note->body }}</p>
                                <div class="mt-4 flex items-center justify-between">
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">{{ $note->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                                <p class="text-sm text-gray-400 italic">No notes recorded for this customer yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-8 flex flex-col">
                    <h3 class="font-bold text-gray-400 mb-6 uppercase text-xs tracking-[0.2em]">Secure Documents</h3>

                    {{-- Updated Document Upload Form --}}
                    <form action="{{ route('customers.documents.store', $customer) }}" method="POST" enctype="multipart/form-data" class="mb-8 p-6 border-2 border-dashed border-indigo-100 rounded-2xl bg-indigo-50/20">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-50 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-xs text-gray-500 font-semibold uppercase">Click to upload file</p>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter">PDF, PNG, JPG (Max 10MB)</p>
                                    </div>
                                    <input type="file" name="document" class="hidden" required />
                                </label>
                            </div>
                            <button class="bg-indigo-600 text-white text-[10px] py-3 rounded-lg uppercase font-bold tracking-widest hover:bg-indigo-700 shadow-md shadow-indigo-100 transition">
                                Upload to Customer Vault
                            </button>
                        </div>
                    </form>

                    <div class="space-y-3 overflow-y-auto max-h-[500px] pr-2">
                        @forelse($customer->documents as $doc)
                            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-xl hover:shadow-md transition group border-l-4 border-l-indigo-500">
                                <div class="flex items-center gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-800 truncate max-w-[200px]">{{ $doc->original_name }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium uppercase">{{ $doc->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-3 py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition uppercase">
                                        View
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                                <p class="text-sm text-gray-400 italic">Vault is currently empty.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
