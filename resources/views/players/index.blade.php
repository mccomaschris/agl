@extends('layouts.admin')

@section('page-heading', 'All Players')

@section('content')

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Player</th>
        <th class="text-center">Team</th>
        <th class="text-center">Position</th>
        <th class="text-center">Current HC</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($players as $player)
        <tr>
          <td><a href="/players/{{ $player->id }}/edit">{{ $player->user->name }}</a></td>
          <td class="text-center">{{ $player->team->name }}</td>
          <td class="text-center">{{ $player->position }}</td>
          <td class="text-center">{{ $player->hc_current }}</td>
          <td class="text-center">
            <form method="post" action="/players/{{ $player->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger btn-sm">Delete</button>
          </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('sidebar')

  @include('layouts.admin-sidebar')

@endsection
