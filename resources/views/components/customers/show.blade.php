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

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-10">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-8">
                        <div class="h-24 w-24 bg-indigo-600 flex items-center justify-center rounded-3xl text-white text-4xl font-bold shadow-lg shadow-indigo-100">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $customer->name }}</h1>
                            <div class="flex items-center gap-4 mt-2">
                                <p class="text-base text-gray-500">{{ $customer->email }}</p>
                                <span class="text-gray-300">|</span>
                                <p class="text-base text-gray-500">{{ $customer->phone ?? 'No phone provided' }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-xs font-bold uppercase tracking-widest text-gray-700 bg-white hover:bg-gray-50 transition">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-8 flex flex-col">
                    <h3 class="font-bold text-gray-400 mb-6 uppercase text-xs tracking-[0.2em]">Internal Notes</h3>

                    <form action="{{ route('customers.notes.store', $customer) }}" method="POST" class="mb-8">
                        @csrf
                        <textarea name="body" rows="3" class="w-full border-gray-200 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 p-4" placeholder="Write an internal update..."></textarea>
                        <button class="mt-3 w-full bg-indigo-600 text-white text-xs py-3 rounded-lg uppercase font-bold tracking-widest hover:bg-indigo-700 shadow-md shadow-indigo-100 transition">
                            Post Note
                        </button>
                    </form>

                    <div class="space-y-4 overflow-y-auto max-h-[400px] pr-4 custom-scrollbar">
                        @forelse($customer->notes()->latest()->get() as $note)
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                                <p class="text-gray-700 leading-relaxed">{{ $note->body }}</p>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="h-1 w-1 bg-gray-300 rounded-full"></div>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">{{ $note->created_at->format('M d, Y • h:i A') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 border-2 border-dashed border-gray-100 rounded-xl">
                                <p class="text-sm text-gray-400 italic">No notes recorded yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-8 flex flex-col">
                    <h3 class="font-bold text-gray-400 mb-6 uppercase text-xs tracking-[0.2em]">Files & Attachments</h3>

                    <form action="{{ route('customers.documents.store', $customer) }}" method="POST" enctype="multipart/form-data" class="mb-8 p-6 border-2 border-dashed border-indigo-50 rounded-xl bg-indigo-50/30">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <label class="block">
                                <span class="sr-only">Choose file</span>
                                <input type="file" name="document" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-xs file:font-semibold
                                    file:bg-indigo-600 file:text-white
                                    hover:file:bg-indigo-700 cursor-pointer
                                "/>
                            </label>
                            <button class="bg-white border border-indigo-200 text-indigo-600 text-[10px] py-2 rounded-lg uppercase font-bold tracking-widest hover:bg-indigo-50 transition">
                                Upload to Vault
                            </button>
                        </div>
                    </form>

                    <div class="grid grid-cols-1 gap-3 overflow-y-auto max-h-[400px] pr-2">
                        @forelse($customer->documents as $doc)
                            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-xl hover:border-indigo-200 hover:shadow-sm transition group">
                                <div class="flex items-center gap-4">
                                    <div class="p-2 bg-indigo-50 rounded-lg">
                                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-700 truncate max-w-[200px]">{{ $doc->original_name }}</span>
                                        <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $doc->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                                    View
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-10 border-2 border-dashed border-gray-100 rounded-xl">
                                <p class="text-sm text-gray-400 italic">Vault is empty.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
