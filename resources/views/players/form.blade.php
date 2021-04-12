{{ csrf_field() }}

<div class="form-group">
  <label for="name" class="col-sm-2 control-label">User</label>
  <div class="col-sm-10">
    <select class="form-control" name="user_id" class="form-control">
      @foreach ($users as $user)
        <option value="{{ $user->id }}"
          {{ (old("user_id") == $user->id ? " selected " : $player->user_id == $user->id ? " selected " : "") }}>
            {{ $user->name }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Team</label>
  <div class="col-sm-10">
    <select class="form-control" name="team_id" class="form-control">
      @foreach ($teams as $team)
        <option value="{{ $team->id }}"
          {{ (old("team_id") == $team->id ? " selected " : $player->team_id == $team->id ? " selected " : "") }}>
            {{ $team->year->name }} Team {{ $team->name }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Position</label>
    <div class="col-sm-10">
      <input type="text" name="position" class="form-control" value="{{ old('position') ?? $player->position }}" required>
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-2 control-label">First HC</label>
    <div class="col-sm-10">
      <input type="text" name="hc_first" class="form-control" value="{{ old('hc_first') ?? $player->hc_first }}" required>
    </div>
</div>

<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-primary">
      {{ $submitButtonText ?? 'Create Player' }}
    </button>
  </div>
</div>
