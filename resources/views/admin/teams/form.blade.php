{{ csrf_field() }}

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Team Name:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('name') ? ' border-red-500 ' : '' }}" name="name" value="{{ old('name') ?? $team->name }}" required>
        @if ($errors->has('name'))
            <div class="admin-form-error">The team name is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Year:</label>
        <div class="relative">
            <select name="year_id" class="{{ $errors->has('year_id') ? ' border-red-500 ' : '' }}">
                @foreach ($years as $year)
                    <option value="{{ $year->id }}"
                        {{ (old("year_id") == $year->id ? " selected " : $team->year_id == $year->id ? " selected " : "") }}>{{ $year->name }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        @if ($errors->has('name'))
            <div class="admin-form-error">The year is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <input class="mr-2 leading-tight" type="checkbox" name="champions" {{ (old('champions') || $team->champions) ? " checked " : "" }}>
        <span class="text-sm font-semibold">
            Season Champion
        </span>
    </div>
</div>

<div class="px-8 py-4 bg-zinc-100 border-t border-zinc-200 flex items-center">
    <button type="submit" class="px-6 py-3 rounded bg-green-500 text-white text-sm font-bold hover:text-white hover:bg-green-600">
        {{ $submitButtonText ?? 'Create Team' }}
    </button>
    <a href="/admin/teams" class="ml-8 text-red-500 font-semibold hover:underline hover:text-red-darker">Cancel</a>
</div>
