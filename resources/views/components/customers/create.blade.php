<x-app-layout>
    <style>
        body { background-color: #F8FAFC !important; }
        .orbix-card {
            background: white;
            border-radius: 32px;
            border: 1px solid rgba(0,0,0,0.02);
            box-shadow: 0 4px 25px -5px rgba(0,0,0,0.03);
        }
    </style>

    <div class="py-12 antialiased text-slate-900">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Area --}}
            <div class="flex items-center justify-between mb-8 px-2">
                <div>
                    <p class="text-[10px] uppercase font-bold text-orange-500 mb-1">Onboarding</p>
                    <h2 class="font-black text-2xl text-slate-900">
                        {{ __('Add New Customer') }}
                    </h2>
                </div>
                <a href="{{ route('customers.index') }}" class="text-xs font-bold  text-slate-400 hover:text-indigo-600 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back
                </a>
            </div>

            <div class="orbix-card p-10">
                <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @include('components._form', [
                        'buttonText' => 'Create Customer',
                        'customer' => null
                    ])
                </form>
            </div>

            {{-- Aesthetic Footer Tip --}}
            <div class="mt-8 p-6 bg-indigo-50/50 rounded-[24px] border border-indigo-100/50 flex items-start gap-4">
                <div class="bg-indigo-500 p-2 rounded-xl text-white shadow-lg shadow-indigo-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-xs font-bold text-indigo-600/70 leading-relaxed">
                    New profiles are initialized with a "Vault" for documents. You can record activity logs immediately after creation.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
