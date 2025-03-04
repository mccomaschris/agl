@extends('layouts.admin')

@section('content')

	<h1 class="mb-8 font-bold text-3xl">
		Years
		<span class="text-green-500 font-medium">/</span>
		<span class="text-grey-700 font-medium">{{ $year->name }}</span>
	</h1>

	<div class="bg-white rounded shadow overflow-hidden max-w-lg">
		<form action="/admin/years/{{ $year->id }}" method="post">
			{{ method_field('PATCH') }}

			@include('admin.years.form', [
				'submitButtonText' => 'Update Year'
			])
		</form>
	</div>

{{--
    <div class="w-full lg:w-2/3 bg-grey-lightest mx-auto py-6 px-4 text-sm text-grey-dark">
      <p>Any updates made here, other than team name, year, and champions will be automatically replaced by the system when new scores are added.</p>
    </div> --}}
@endsection
