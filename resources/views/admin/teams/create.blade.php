@extends('layouts.admin')

@section('page-title')
    <div class="w-full lg:w-1/2 mx-auto">
        <div class="flex flex-wrap justify-between items-center">
            <h1 class="text-center text-2xl lg:text-3xl mt-6 mb-6 tracking-tight">Create a Team</h1>
        </div>
    </div> 
@endsection

@section('content')

    <div class="w-full lg:w-1/2 bg-grey-lightest mx-auto py-6 px-4 text-sm text-grey-dark">
      <p>Any updates made here, other than team name, year, and champions will be automatically replaced by the system when new scores are added.</p>
    </div>

    <form class="mx-auto px-8 pt-6 pb-8 mb-4 w-2/3" action="/admin/teams" method="post">
			@include('admin.teams.form', [
				'team' => new App\Team
			])
    </form>
@endsection

