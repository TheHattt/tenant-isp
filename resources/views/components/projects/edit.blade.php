
<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">Edit Project</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Update your project details below
                </p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-[24px] shadow-sm border border-slate-100 p-8">
                @if ($errors->any())
                    <div class="bg-red-50 p-4 mb-4 rounded-lg">
                        <ul class="text-red-600 text-sm font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Include form inputs --}}
                    @include('components.projects.Form', ['project' => $project])

                    {{-- Submit --}}
                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('projects.index') }}"
                           class="px-6 py-2 rounded-3xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300 transition">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-6 py-2 rounded-3xl bg-orange-500 text-white font-bold hover:bg-orange-600 transition">
                            Update Project
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
