<x-app-layout>
    <style>
        body { background-color: #F8FAFC !important; }
        .orbix-card {
            background: white;
            border-radius: 32px;
            border: 1px solid rgba(0,0,0,0.02);
            box-shadow: 0 4px 25px -5px rgba(0,0,0,0.03);
        }
        .note-card {
            background-color: #F8FAFC; /* Restored soft background */
            border: 1px solid #F1F5F9;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .note-card:hover {
            background-color: white;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.04);
            transform: translateY(-2px);
        }
    </style>

    <div class="py-10 antialiased text-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- RESTORED: HEADER WITH BACK LINK --}}
            <div class="flex items-center justify-between mb-2 px-2">
                <h2 class="font-black text-xl text-slate-800 tracking-tight">Customer Profile</h2>
                <a href="{{ route('customers.index') }}" class="text-xs font-bold uppercase tracking-widest text-indigo-600 hover:text-orange-500 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Directory
                </a>
            </div>

            {{-- 1. HEADER PROFILE CARD --}}
            <div class="orbix-card p-10">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                        <div class="relative">
                            <div class="h-24 w-24 bg-indigo-600 rounded-[28px] flex items-center justify-center text-white text-3xl font-bold shadow-xl shadow-indigo-100">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 bg-orange-500 h-6 w-6 rounded-full border-4 border-white"></div>
                        </div>

                        <div>
                            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $customer->name }}</h1>
                            <div class="flex flex-wrap justify-center md:justify-start gap-x-10 gap-y-2 mt-3">
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Email Address</p>
                                    <p class="text-sm font-semibold text-slate-600">{{ $customer->email }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Phone Number</p>
                                    <p class="text-sm font-semibold text-slate-600">{{ $customer->phone ?? '---' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('customers.edit', $customer) }}" class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-[11px] font-bold uppercase tracking-wider hover:bg-orange-600 transition-all shadow-md">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- 2. TIMELINE NOTES (LEFT SIDE) --}}
                <div class="lg:col-span-7 orbix-card p-10">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-lg font-black text-slate-900">Activity manager</h3>
                        <div class="h-8 w-8 bg-slate-50 rounded-xl flex items-center justify-center">
                            <div class="h-1.5 w-1.5 bg-orange-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>

                    <form action="{{ route('customers.notes.store', $customer) }}" method="POST" class="mb-10 relative">
                        @csrf
                        <textarea name="body" rows="2" class="w-full border-none bg-slate-50 rounded-[24px] text-sm focus:ring-2 focus:ring-orange-500/10 p-5 placeholder-slate-400 transition-all" placeholder="Add an internal note..."></textarea>
                        <button class="absolute right-3 bottom-3 bg-orange-500 p-2.5 rounded-xl text-white shadow-lg shadow-orange-100 hover:scale-105 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </form>

                    <div class="relative ml-4">
                        <div class="absolute left-0 top-1 bottom-0 w-px border-l-2 border-dotted border-slate-200"></div>

                        <div class="space-y-6">
                            @foreach($customer->notes()->latest()->get() as $note)
                                <div class="relative pl-10 group">
                                    <div class="absolute left-[-5px] top-5 h-2.5 w-2.5 rounded-full bg-white border-2 border-indigo-500 shadow-[0_0_0_4px_white] z-10"></div>

                                    {{-- RESTORED: Note Background and Styling --}}
                                    <div class="note-card p-5">
                                        <p class="text-sm font-medium text-slate-700 leading-relaxed">{{ $note->body }}</p>
                                        <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mt-3">{{ $note->created_at->format('d M, Y • H:i') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 3. VAULT (RIGHT SIDE) --}}
                <div class="lg:col-span-5 orbix-card p-10">
                    <h3 class="text-lg font-black text-slate-900 mb-8">Business plans</h3>

                    <form action="{{ route('customers.documents.store', $customer) }}" method="POST" enctype="multipart/form-data" class="mb-8">
                        @csrf
                        <label class="flex items-center justify-between p-4 bg-orange-50/50 rounded-[24px] cursor-pointer border-2 border-dashed border-orange-100 hover:bg-orange-100/30 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="bg-orange-500 p-2 rounded-lg text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-orange-600">Upload to Vault</span>
                            </div>
                            <input type="file" name="document" class="hidden" onchange="this.form.submit()">
                        </label>
                    </form>

                    <div class="space-y-3 overflow-y-auto max-h-[450px] pr-2 custom-scrollbar">
                        @foreach($customer->documents as $doc)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-transparent hover:border-slate-100 hover:bg-white hover:shadow-sm transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="h-9 w-9 bg-white rounded-xl flex items-center justify-center text-indigo-500 shadow-sm border border-slate-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div class="truncate max-w-[140px]">
                                        <p class="text-sm font-bold text-slate-800 truncate">{{ $doc->original_name }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase">{{ $doc->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="h-8 w-8 flex items-center justify-center text-slate-300 hover:text-orange-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
