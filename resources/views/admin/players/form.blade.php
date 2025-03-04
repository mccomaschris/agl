{{ csrf_field() }}

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">User:</label>
        <div class="relative">
            <select name="user_id" class="{{ $errors->has('user_id') ? ' border-red-500 ' : '' }}">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ (old("user_id") == $user->id ? " selected " : $player->user_id == $user->id ? " selected " : "") }}>{{ $user->name }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        @if ($errors->has('user_id'))
            <div class="admin-form-error">The user is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Team:</label>
        <div class="relative">
            <select name="team_id" class="{{ $errors->has('team_id') ? ' border-red-500 ' : '' }}">
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}"
                        {{ (old("team_id") == $team->id ? " selected " : $player->team_id == $team->id ? " selected " : "") }}>{{ $team->year->name }} Team #{{ $team->name }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        @if ($errors->has('team_id'))
            <div class="admin-form-error">The team is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Position:</label>
        <div class="relative">
            <select name="position" class="{{ $errors->has('position') ? ' border-red-500 ' : '' }}">
                <option value="{{ $team->id }}" {{ (old("position") == 1 ? " selected" : $player->position == 1 ? " selected" : "") }}>1</option>
                <option value="{{ $team->id }}" {{ (old("position") == 2 ? " selected" : $player->position == 2 ? " selected" : "") }}>2</option>
                <option value="{{ $team->id }}" {{ (old("position") == 3 ? " selected" : $player->position == 3 ? " selected" : "") }}>3</option>
                <option value="{{ $team->id }}" {{ (old("position") == 4 ? " selected" : $player->position == 4 ? " selected" : "") }}>4</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        @if ($errors->has('position'))
            <div class="admin-form-error">The team is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <label class="admin-form-label">Starting HC:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('hc_current') ? ' border-red-500 ' : '' }}" name="hc_current" value="{{ old('hc_current') ?? $player->hc_current }}" required>
        @if ($errors->has('hc_current'))
            <div class="admin-form-error">The starting handicap is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/4 px-4">
        <label class="admin-form-label">HC First:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('hc_first') ? ' border-red-500 ' : '' }}" name="hc_first" value="{{ old('hc_first') ?? $player->hc_first }}">
        @if ($errors->has('hc_first'))
            <div class="admin-form-error">The starting handicap is required.</div>
        @endif
    </div>
    <div class="w-full lg:w-1/4 px-4">
        <label class="admin-form-label">HC Second:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('hc_second') ? ' border-red-500 ' : '' }}" name="hc_second" value="{{ old('hc_second') ?? $player->hc_second }}">
        @if ($errors->has('hc_second'))
            <div class="admin-form-error">The starting handicap is required.</div>
        @endif
    </div>
    <div class="w-full lg:w-1/4 px-4">
        <label class="admin-form-label">HC Third:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('hc_third') ? ' border-red-500 ' : '' }}" name="hc_third" value="{{ old('hc_third') ?? $player->hc_third }}">
        @if ($errors->has('hc_third'))
            <div class="admin-form-error">The starting handicap is required.</div>
        @endif
    </div>
    <div class="w-full lg:w-1/4 px-4">
        <label class="admin-form-label">HC Fourth:</label>
        <input ref="input" class="admin-form-input {{ $errors->has('hc_fourth') ? ' border-red-500 ' : '' }}" name="hc_fourth" value="{{ old('hc_fourth') ?? $player->hc_fourth }}">
        @if ($errors->has('hc_fourth'))
            <div class="admin-form-error">The starting handicap is required.</div>
        @endif
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <input class="mr-2 leading-tight" type="checkbox" name="substitute" {{ (old('substitute') || $player->substitute) ? " checked " : "" }}>
        <span class="text-sm font-semibold">
            Substitute
        </span>
    </div>
</div>

<div class="m-8 flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <input class="mr-2 leading-tight" type="checkbox" name="on_leave" {{ (old('on_leave') || $player->on_leave) ? " checked " : "" }}>
        <span class="text-sm font-semibold">
            On Leave
        </span>
    </div>
</div>

<div class="px-8 py-4 bg-grey-100 border-t border-grey-200 flex items-center">
    <button type="submit" class="btn btn-green">
        {{ $submitButtonText ?? 'Create Player' }}
    </button>
    <a href="/admin/players" class="ml-8 text-red-500 font-semibold hover:underline hover:text-red-darker">Cancel</a>
</div>
