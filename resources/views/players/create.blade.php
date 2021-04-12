@extends('layouts.admin')

@section('page-heading', 'Create New Player')

@section('content')
<div class="col-md-8 col-md-offset-2">
  @if (count($errors) > 0)
    @include('layouts.errors')
  @endif

  <form class="form-horizontal" action="/players" method="post" class="form-horizontal">

    @include('players.form', [
      'player' => new App\Models\Player
    ])

  </form>

</div>
@endsection

@section('sidebar')

  @include('layouts.admin-sidebar')

@endsection
