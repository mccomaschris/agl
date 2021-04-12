{{ csrf_field() }}

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Year Name:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('name') ? ' border-red-500 ' : '' }}" name="name" value="{{ old('name') ?? $year->name }}" placeholder="2019" required>
        @if ($errors->has('name'))
            <div class="admin-form-error">The year name is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <input class="mr-2 leading-tight" type="checkbox" name="active" {{ (old('active') || $year->active) ? " checked " : "" }}>
        <span class="text-sm font-semibold">
            Active
        </span>
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Start Date:</label>
        <input class="admin-form-input {{ $errors->has('start_date') ? ' border-red-500 ' : '' }}" name="start_date" value="{{ old('start_date') ?? $year->start_date }}" placeholder="YYYY-MM-DD">
        @if ($errors->has('start_date'))
            <div class="admin-form-error">Please enter a date in MMMM-DD-YY format.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Skip Date:</label>
        <input class="admin-form-input {{ $errors->has('skip_date') ? ' border-red-500 ' : '' }}" name="skip_date" value="{{ old('skip_date') ?? $year->skip_date }}" placeholder="YYYY-MM-DD">
        @if ($errors->has('skip_date'))
            <div class="admin-form-error">Please enter a date in MMMM-DD-YY format.</div>
        @endif
    </div>
</div>

<div class="px-8 py-4 bg-grey-100 border-t border-grey-200 flex items-center">
    <button type="submit" class="btn btn-green">
        {{ $submitButtonText ?? 'Create Year' }}
    </button>
    <a href="/admin/years" class="ml-8 text-red-500 font-semibold hover:underline hover:text-red-darker">Cancel</a>
</div>
