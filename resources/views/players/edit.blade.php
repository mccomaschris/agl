@extends('layouts.admin')

@section('page-heading', 'Edit Player')

@section('content')
<div class="col-md-8 col-md-offset-2">
  @if (count($errors) > 0)
    @include('layouts.errors')
  @endif

  <form class="form-horizontal" action="/players/{{ $player->id }}" method="post" class="form-horizontal">
    {{ method_field('PATCH') }}

    @include('players.form', [
      'submitButtonText' => 'Update Player'
    ])

  </form>

</div>
@endsection

@section('sidebar')

  @include('layouts.admin-sidebar')

@endsection
