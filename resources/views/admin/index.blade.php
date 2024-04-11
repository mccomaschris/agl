@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
	<h1 class="mb-8 font-bold text-3xl">Quick Tools</h1>

	<livewire:admin-controls />

	<div class="flex items-center">
		<div>
			@if ($last_week)
				<a href="{{ route('admin.week-scores', ['week' => $last_week->id]) }}" class="btn btn-green">Update Last Week's Scores</a>
			@endif
		</div>
		<div class="ml-4">
			<button data-controller="update-button" data-update-button-url="/admin/cache" data-action="update-button#update" class="btn btn-green">Clear Cache</button>
		</div>
	</div>

	<h2 class="mb-8 mt-16 font-bold text-2xl">Adjust Weeks</h2>

</div>
@endsection
