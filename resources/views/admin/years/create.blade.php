@extends('layouts.admin')

@section('content')

    <h1 class="mb-8 font-bold text-3xl">
		Years
		<span class="text-green-500 font-medium">/</span> 
		<span class="text-grey-700 font-medium">Create</span>
    </h1>
    
    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
        <form action="/admin/years" method="post">
            @include('admin.years.form', [
                'year' => new App\Year
            ])
        </form>
    </div>
@endsection

