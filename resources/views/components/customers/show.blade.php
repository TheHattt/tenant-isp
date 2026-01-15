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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm transition">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex items-center gap-5">
                            <div class="h-16 w-16 bg-indigo-600 flex items-center justify-center rounded-full text-white text-2xl font-bold shadow-sm">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $customer->name }}</h1>
                                <p class="text-sm text-gray-500">Member since {{ $customer->created_at->format('M Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            @can('update', $customer)
                                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                    Edit
                                </a>
                            @endcan

                            @can('delete', $customer)
                                <button
                                    type="button"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-customer-deletion'); $dispatch('set-deletion-target', { action: '{{ route('customers.destroy', $customer) }}', name: '{{ $customer->name }}' })"
                                    class="inline-flex items-center px-4 py-2 bg-red-50 border border-red-200 text-red-600 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white transition shadow-sm"
                                >
                                    Delete
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Email Address</label>
                            <p class="text-lg font-medium text-gray-700">{{ $customer->email ?? 'Not provided' }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Phone Number</label>
                            <p class="text-lg font-medium text-gray-700">{{ $customer->phone ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        Internal Notes
                    </h3>

                    <form action="{{ route('customers.notes.store', $customer) }}" method="POST" class="mb-10">
                        @csrf
                        <div class="relative">
                            <textarea
                                name="body"
                                rows="3"
                                placeholder="Add an internal note about this customer..."
                                class="w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm"
                            ></textarea>
                            @error('body')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="mt-2 flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest rounded-md hover:bg-indigo-700 transition shadow-sm">
                                    Add Note
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px before:h-full before:w-0.5 before:bg-gradient-to-b before:from-gray-200 before:via-gray-200 before:to-transparent">
                        @forelse($customer->notes()->latest()->get() as $note)
                            <div class="relative flex items-start gap-6 group">
                                <div class="absolute left-0 mt-1.5 h-2.5 w-2.5 rounded-full border-2 border-white bg-gray-300 group-hover:bg-indigo-500 transition-colors ml-[15px] z-10"></div>

                                <div class="flex-1 bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm transition hover:shadow-md">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                            {{ $note->created_at->format('M d, Y • g:i A') }}
                                        </span>

                                        <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        "{{ $note->body }}"
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-gray-400 text-sm italic pl-10">
                                No notes recorded yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-customer-deletion" focusable>
        <div
            x-data="{ action: '', name: '' }"
            x-on:set-deletion-target.window="action = $event.detail.action; name = $event.detail.name"
            class="p-6"
        >
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete <span x-text="name" class="font-bold text-red-600"></span>?
            </h2>

            <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                This will permanently remove the customer and all related internal notes. This action cannot be undone.
            </p>

            <form method="post" :action="action" class="mt-6 flex justify-end gap-3">
                @csrf @method('delete')
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <x-danger-button>Delete Customer</x-danger-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>
