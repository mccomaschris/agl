@extends('layouts.default')

@section('page-heading')
	<h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight">Members</h1>
@endsection

@section('content')
	<div class="flex flex-wrap mt-6">
		@foreach($users as $user)
			<div class="w-full lg:w-1/4 mb-6 leading-normal">
				<p class="font-semibold">{{ $user->name }}</p>
				<p>{{  $user->phone == '304-123-4567' ? '' : $user->phone }}</p>
				<p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
			</div>
		@endforeach
	</div>
@endsection
