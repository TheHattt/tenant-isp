
<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl font-black text-slate-900 mb-8">
                Create Project
            </h1>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                    @csrf
                    <x-projects.Form  :customers="$customers" :project="$project" />

                    <div class="flex justify-end gap-3 pt-6 items-center">
                        <a href="{{ route('projects.index') }}"
                           class="text-sm font-bold text-slate-400 hover:text-slate-600">
                            Cancel
                        </a>

                        <button
                            class="px-6 py-3 bg-orange-500 text-white rounded-xl text-xs font-black  hover:bg-orange-600">
                            Save Project
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
