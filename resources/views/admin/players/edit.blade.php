@extends('layouts.admin')

@section('content')

    <h1 class="mb-8 font-bold text-3xl">
		Players
		<span class="text-green-500 font-medium">/</span>
		<span class="text-grey-700 font-medium">{{ $player->user->name }}</span>
    </h1>

    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
        <form action="/admin/players/{{ $player->id }}" method="post">
            {{ method_field('PATCH') }}

            @include('admin.players.form', [
                'submitButtonText' => 'Update Player'
            ])
        </form>
    </div>
@endsection
