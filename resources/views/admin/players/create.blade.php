@extends('layouts.admin')

@section('content')

    <h1 class="mb-8 font-bold text-3xl">
		Players
		<span class="text-green-500 font-medium">/</span>
		<span class="text-zinc-700 font-medium">Create</span>
    </h1>

    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
        <form action="/admin/players" method="post">
            @include('admin.players.form', [
                'player' => new App\Models\Player
            ])
        </form>
    </div>
@endsection
