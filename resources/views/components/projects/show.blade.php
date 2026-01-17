
<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        {{ $project->name }}
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Project Details
                    </p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('projects.edit', $project) }}"
                       class="px-4 py-2 bg-orange-100 text-orange-700 font-bold rounded-lg hover:bg-orange-200 transition">
                        Edit
                    </a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-100 text-red-700 font-bold rounded-lg hover:bg-red-200 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- Project Info Card --}}
            <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm p-6 space-y-6">

                <div>
                    <h2 class="text-sm font-bold text-slate-400 mb-1">Customer</h2>
                    <p class="text-base font-semibold text-slate-700">
                        {{ $project->customer->name ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-slate-400 mb-1">Description</h2>
                    <p class="text-base text-slate-600">
                        {{ $project->description ?? 'No description provided' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-sm font-bold text-slate-400 mb-1">Status</h2>
                        @php
                            $statusColors = [
                                'planning'     => 'bg-green-100 text-green-700',
                                'in_progress'  => 'bg-yellow-100 text-yellow-700',
                                'completed'    => 'bg-blue-100 text-blue-700',
                                'on_hold'      => 'bg-orange-100 text-orange-700',
                                'cancelled'    => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$project->status] ?? 'bg-slate-200 text-slate-700' }}">
                            {{ str_replace('_', ' ', $project->status) }}
                        </span>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-400 mb-1">Priority</h2>
                        @php
                            $priorityColors = [
                                'low'    => 'bg-green-100 text-green-700',
                                'medium' => 'bg-yellow-100 text-yellow-700',
                                'high'   => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $priorityColors[$project->priority] ?? 'bg-slate-200 text-slate-700' }}">
                            {{ $project->priority ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-sm font-bold text-slate-400 mb-1">Start Date</h2>
                        <p class="text-slate-700">{{ optional($project->start_date)->format('d/m/Y') ?? '-' }}</p>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-400 mb-1">End Date</h2>
                        <p class="text-slate-700">{{ optional($project->end_date)->format('d/m/Y') ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-slate-400 mb-1">Budget</h2>
                    <p class="text-slate-700">${{ number_format($project->budget, 2) ?? '0.00' }}</p>
                </div>

            </div>

            {{-- Back button --}}
            <div class="mt-6">
                <a href="{{ route('projects.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-slate-100 rounded-3xl font-bold text-slate-700 hover:bg-slate-200 transition">
                    Back to Projects
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
