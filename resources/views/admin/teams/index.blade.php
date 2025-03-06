@extends('layouts.admin')

@section('content')
	<div class="mb-6 flex justify-between items-center">
		<h1 class="font-bold text-3xl">Teams</h1>
	</div>

	<div class="bg-white rounded shadow overflow-x-auto">
		<table class="w-full whitespace-no-wrap">
			<thead>
				<tr class="text-left font-bold">
					<th class="px-6 pt-6 pb-4">Name</th>
					<th class="px-6 pt-6 pb-4" colspan="2">Season</th>
				</tr>
			</thead>
			<tbody>
				@forelse($years as $year)
					@foreach ($year->teams as $team)
						<tr class="hover:bg-zinc-100 focus-within:bg-zinc-lightest group text-zinc-500">
							<td class="border-t px-6 py-4  group-hover:text-green-500 ">
								<a href="/admin/teams/{{ $team->id }}/edit" class="text-zinc-500">{{ $team->year->name }} Team {{ $team->name }}</a>
							</td>
							<td class="border-t px-6 py-4 group-hover:text-green-500">{{ $team->year->name }}</td>
							<td class="border-t w-px">
								<a href="/admin/teams/{{ $team->id }}/edit" class="text-zinc-500 group-hover:text-green-500 px-4">
									<svg xmlns="http://www.w3.org/2000/svg" class="block w-6 h-6 fill-current" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
								</a>
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td class="border-t px-6 py-4" colspan="3">No teams found.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection
