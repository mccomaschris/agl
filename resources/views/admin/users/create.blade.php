@extends('layouts.admin')

@section('content')

    <h1 class="mb-8 font-bold text-3xl">
		Users
		<span class="text-green-500 font-medium">/</span>
		<span class="text-zinc-700 font-medium">Create</span>
    </h1>

    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
        <form action="/admin/users" method="post">
            @include('admin.users.form', [
                'user' => new App\User
            ])
        </form>
    </div>
@endsection
