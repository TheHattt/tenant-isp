
{{-- Customer --}}
<div>
    <label class="block text-xs font-bold text-slate-400 mb-2">
        Customer
    </label>
    <select name="customer_id"
            class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
        <option value="">Select customer</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}"
                @selected(old('customer_id', $project->customer_id ?? '') == $customer->id)>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>
    @error('customer_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

{{-- Project Name --}}
<div>
    <label class="block text-xs font-bold text-slate-400 mb-2">
        Project Name
    </label>
    <input type="text" name="name"
           value="{{ old('name', $project->name ?? '') }}"
           class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

{{-- Description --}}
<div>
    <label class="block text-xs font-bold text-slate-400 mb-2">
        Description
    </label>
    <textarea name="description" rows="4"
              class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">{{ old('description', $project->description ?? '') }}</textarea>
</div>

{{-- Status & Priority --}}
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-xs font-bold text-slate-400 mb-2">
            Status
        </label>
        <select name="status"
                class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
            @foreach(['planning', 'in_progress', 'completed', 'on_hold', 'cancelled'] as $status)
                <option value="{{ $status }}"
                    @selected(old('status', $project->status ?? '') == $status)>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-400 mb-2">
            Priority
        </label>
        <select name="priority"
                class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
            @foreach(['low','medium','high'] as $priority)
                <option value="{{ $priority }}"
                    @selected(old('priority', $project->priority ?? '') == $priority)>
                    {{ ucfirst($priority) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Dates --}}
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-xs font-bold text-slate-400 mb-2">
            Start Date
        </label>
        <input type="date" name="start_date"
               value="{{ old('start_date', optional($project->start_date)->format('Y-m-d') ?? '') }}"
               class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
        @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-400 mb-2">
            End Date
        </label>
        <input type="date"
               name="end_date"
               min="{{ date('Y-m-d') }}"
               value="{{ old('end_date', optional($project->end_date)->format('Y-m-d') ?? '') }}"
               class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
        @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- Budget --}}
<div>
    <label class="block text-xs font-bold text-slate-400 mb-2">
        Budget
    </label>
    <input type="number" step="0.01" name="budget"
           value="{{ old('budget', $project->budget ?? '') }}"
           class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500">
</div>
