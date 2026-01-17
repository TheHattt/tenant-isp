
<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ deleteModal: false, deleteId: null }">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Projects</h1>
                    <p class="text-sm font-bold text-slate-500 mt-1">
                        Total Projects: <span class="text-orange-500">{{ $projects->total() }}</span>
                    </p>
                </div>

                <a href="{{ route('projects.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-orange-500 rounded-3xl font-bold text-[11px] text-white hover:bg-orange-600 transition shadow-lg shadow-orange-100">
                    Add Project
                </a>
            </div>

            @php
                $statusColors = [
                    'planning'     => 'bg-green-100 text-green-700',
                    'in_progress'  => 'bg-yellow-100 text-yellow-700',
                    'completed'    => 'bg-blue-100 text-blue-700',
                    'on_hold'      => 'bg-orange-100 text-orange-700',
                    'cancelled'    => 'bg-red-100 text-red-700',
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
                        <tr class="border-b border-slate-100 shadow-sm">
                            <th class="px-8 py-5 text-sm font-bold text-slate-500">Project</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500">Customer</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500">Status</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500">Priority</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500">Start Date</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500">End Date</th>
                            <th class="px-8 py-5 text-right text-sm font-bold text-slate-500">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-50">
                        @forelse($projects as $project)
                            <tr class="hover:bg-orange-50/30 transition">
                                <td class="px-8 py-5">
                                    <div class="font-bold text-slate-900">{{ $project->name }}</div>
                                    <div class="text-[10px] text-slate-400">
                                        {{ $project->customer->name ?? 'No customer' }}
                                    </div>
                                </td>

                                <td class="px-8 py-5 text-sm font-bold text-slate-600">
                                    {{ $project->customer->name ?? 'N/A' }}
                                </td>

                                <td class="px-8 py-5">
                                    <span class="text-xs font-bold px-3 py-1 rounded-full
                                        {{ $statusColors[$project->status] ?? 'bg-slate-200 text-slate-700' }}">
                                        {{ str_replace('_', ' ', $project->status) }}
                                    </span>
                                </td>

                                <td class="px-8 py-5">
                                    <span class="text-xs font-bold px-3 py-1 rounded-full
                                        {{ $priorityColors[$project->priority] ?? 'bg-slate-200 text-slate-700' }}">
                                        {{ $project->priority ?? 'No priority' }}
                                    </span>
                                </td>

                                <td class="px-8 py-5">
                                    {{ optional($project->start_date)->format('d/m/Y') ?? '-' }}
                                </td>

                                <td class="px-8 py-5">
                                    {{ optional($project->end_date)->format('d/m/Y') ?? '-' }}
                                </td>

                                <td class="px-8 py-5 text-right flex justify-end gap-2">
                                    <a href="{{ route('projects.edit', $project) }}"
                                       class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 font-bold text-xs hover:bg-orange-200 transition">
                                        Edit
                                    </a>

                                    <button @click="deleteModal = true; deleteId = {{ $project->id }}"
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-bold text-xs hover:bg-red-200 transition">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-8 py-20 text-center text-slate-300 text-xs font-bold">
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

            {{-- Animated Delete Confirmation Modal --}}
            <div
                x-show="deleteModal"
                x-cloak
                x-transition.opacity.duration.300ms
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 shadow-lg backdrop-blur-md"
            >
                <div
                    x-show="deleteModal"
                    x-transition.scale.duration.300ms
                    class="bg-white rounded-lg shadow-lg w-96 p-6"
                >
                    <h2 class="text-lg font-bold text-slate-800 mb-4">Confirm Delete</h2>
                    <p class="text-sm text-slate-600 mb-6">Are you sure you want to delete this project? This action cannot be undone.</p>
                    <div class="flex justify-end gap-3">
                        <button @click="deleteModal = false"
                                class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-bold hover:bg-gray-300 transition">
                            Cancel
                        </button>
                        <form :action="`/projects/${deleteId}`" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 rounded-full bg-red-600 text-white font-bold hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
