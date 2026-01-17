<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="py-10" x-data="{ showToast: {{ session('success') ? 'true' : 'false' }} }">

        {{-- Toast Notification --}}
        <template x-if="showToast">
            <div x-init="setTimeout(() => showToast = false, 3000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-y-2 opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed top-10 right-5 z-50 bg-green-300 w-full max-w-xl text-white px-6 py-3 rounded-2xl shadow-lg flex items-center gap-3">
                <div class="bg-green-500 rounded-full p-1">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Projects</h1>
                    <p class="text-sm font-bold text-slate-400 mt-1 ">Workspace Overview</p>
                </div>

                <a href="{{ route('projects.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-orange-500 rounded-3xl font-bold text-[11px] text-white hover:bg-orange-600 transition shadow-lg shadow-orange-100 ">
                    Add Project
                </a>
            </div>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400">Total Projects</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalCount }}</p>
                </div>

                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm border-l-2 border-l-orange-300">
                    <p class="text-[10px] font-bold text-slate-400">In Progress</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $inProgressCount }}</p>
                </div>

                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm border-l-2 border-l-red-300">
                    <p class="text-[10px] font-bold text-slate-400">High Priority</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $highPriorityCount }}</p>
                </div>
            </div>

            @php
                $statusColors = [
                    'planning'    => 'bg-green-100 text-green-700',
                    'in_progress' => 'bg-yellow-100 text-yellow-700',
                    'completed'   => 'bg-blue-100 text-blue-700',
                    'on_hold'     => 'bg-orange-100 text-orange-700',
                    'cancelled'   => 'bg-red-100 text-red-700',
                ];

                $priorityColors = [
                    'low'    => 'bg-green-100 text-green-700',
                    'medium' => 'bg-yellow-100 text-yellow-700',
                    'high'   => 'bg-red-100 text-red-700',
                ];
            @endphp

            {{-- Table --}}
            <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400">Project</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400">Customer</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400">Status</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400">Priority</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-50">
                        @forelse($projects as $project)
                            <tr class="hover:bg-orange-50/30 transition group">
                                <td class="px-8 py-5">
                                    <a href="{{ route('projects.show', $project) }}" class="font-bold text-slate-900 group-hover:text-orange-600 transition">
                                        {{ $project->name }}
                                    </a>
                                </td>

                                <td class="px-8 py-5 text-sm font-bold text-slate-600">
                                    {{ $project->customer->name ?? 'N/A' }}
                                </td>

                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black {{ $statusColors[$project->status] ?? 'bg-slate-100 text-slate-500' }}">
                                        {{ str_replace('_', ' ', $project->status) }}
                                    </span>
                                </td>

                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black {{ $priorityColors[$project->priority] ?? 'bg-slate-100 text-slate-500' }}">
                                        {{ $project->priority }}
                                    </span>
                                </td>

                                <td class="px-8 py-5 text-right flex justify-end gap-2">
                                    <a href="{{ route('projects.edit', $project) }}"
                                       class="px-4 py-1.5 rounded-full bg-slate-50 text-slate-600 font-bold text-[10px] hover:bg-orange-100 hover:text-orange-600 transition">
                                        Edit
                                    </a>

                                    <button
                                        @click="$dispatch('open-modal', 'confirm-project-deletion'); $dispatch('set-deletion-target', { action: '{{ route('projects.destroy', $project) }}', name: '{{ $project->name }}' })"
                                        class="px-4 py-1.5 rounded-full bg-red-50 text-red-600 font-bold text-[10px]  hover:bg-red-500 hover:text-white transition">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-slate-300 text-xs font-bold uppercase tracking-widest">
                                    No projects found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-8 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-modal name="confirm-project-deletion" focusable>
        <div x-data="{ action: '', name: '' }"
             x-on:set-deletion-target.window="action = $event.detail.action; name = $event.detail.name"
             x-cloak
             class="p-8">

            <div x-show="name"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">

                <h2 class="text-xl font-bold text-slate-900">
                    Delete <span x-text="name" class="text-red-500"></span>?
                </h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">This action is permanent and cannot be undone.</p>

                <form method="post" :action="action" class="mt-8 flex justify-end gap-3">
                    @csrf
                    @method('delete')

                    <button type="button"
                            x-on:click="$dispatch('close')"
                            class="px-6 py-2 rounded-3xl bg-slate-100 text-slate-600 font-bold text-xs hover:bg-slate-200 transition">
                        Cancel
                    </button>

                    <button type="submit"
                            class="px-6 py-2 rounded-3xl bg-red-500 text-white font-bold text-xs hover:bg-red-600 transition shadow-lg shadow-red-100">
                        Delete Project
                    </button>
                </form>
            </div>
        </div>
    </x-modal>
</x-app-layout>
