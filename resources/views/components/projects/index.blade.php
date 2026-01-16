<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        Projects
                    </h1>
                    <p class="text-sm font-bold text-slate-500 mt-1">
                        Total Projects:
                        <span class="text-orange-500">{{ $projects->total() }}</span>
                    </p>
                </div>

                <a href="{{ route('projects.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-orange-500 rounded-3xl font-bold text-[11px] text-white hover:bg-orange-600 transition shadow-lg shadow-orange-100">
                    Add Project
                </a>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 shadow-sm">
                            <th class="px-8 py-5 text-sm font-bold text-slate-500 ">Project</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500 ">Customer</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500 ">Status</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500 ">Start Date</th>
                            <th class="px-8 py-5 text-sm font-bold text-slate-500 ">End Date</th>
                            <th class="px-8 py-5 text-right text-sm font-bold text-slate-500">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-50">
                        @forelse($projects as $project)
                            <tr class="hover:bg-orange-50/30 transition">
                                <td class="px-8 py-5">
                                    <div class="font-black text-slate-900">
                                        {{ $project->name }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 uppercase">
                                        {{ $project->priority ?? 'No priority' }}
                                    </div>
                                </td>

                                <td class="px-8 py-5 text-sm font-bold text-slate-600">
                                    {{ $project->customer->name }}
                                </td>

                                <td class="px-8 py-5">
                                    <span class="text-xs font-black uppercase px-3 py-1 rounded-full
                                        @if($project->status === 'open') bg-green-100 text-green-700
                                        @elseif($project->status === 'in_progress') bg-yellow-100 text-yellow-700
                                        @else bg-slate-200 text-slate-700
                                        @endif">
                                        {{ str_replace('_', ' ', $project->status) }}
                                    </span>
                                </td>

                                <td class="px-8 py-5">
                                    {{ $project->start_date->format('d/m/Y') }}
                                </td>

                                <td class="px-8 py-5">
                                    {{ $project->end_date->format('d/m/Y') }}
                                </td>

                                <td class="px-8 py-5 text-right">
                                    <a href="{{ route('projects.edit', $project) }}"
                                       class="text-slate-400 hover:text-orange-500">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center text-slate-300 uppercase text-xs font-black">
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
</x-app-layout>
