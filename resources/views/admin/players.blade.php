@extends('layouts.admin')


@section('page-title')
  <h1 class="text-center text-2xl lg:text-3xl mt-6 mb-6 tracking-tight">{{ $year->name }} Scores - {{ $player->user->name }} Scores</h1>
@endsection

@section('content')
<div class="flex flex-col mt-2">
	<div class="w-full mb-8">
		<div class="flex flex-wrap -mx-4">
				<div class="w-full lg:w-1/3 px-4">
					<div class="relative">
						<select class="block appearance-none w-full bg-zinc-lighter border border-zinc-light text-zinc-800 py-2 px-2 pr-8 rounded" onchange="location = this.value;">
							@foreach($years as $item)
								<option value="/admin/years/{{ $item->id }}"
									@if ($year->id == $item->id)
									selected
									@endif
								>{{ $item->name }} Scores</option>
							@endforeach
						</select>
						<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-800">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
						</div>
					</div>
				</div>
				<div class="w-full lg:w-1/3 px-4">
					<div class="relative">
						<select class="block appearance-none w-full bg-zinc-lighter border border-zinc-light text-zinc-800 py-2 px-2 pr-8 rounded" onchange="location = this.value;">
							@foreach($weeks as $item)
								<option value="/admin/scores/week/{{ $item->id }}">Scores for Week {{ $item->week_order }} ({{ date('F d, Y', strtotime($item->week_date)) }})</option>
							@endforeach
						</select>
						<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-800">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
						</div>
					</div>
				</div>
				<div class="w-full lg:w-1/3 px-4">
					<div class="relative">
						<select class="block appearance-none w-full bg-zinc-lighter border border-zinc-light text-zinc-800 py-2 px-2 pr-8 rounded" onchange="location = this.value;">
							@foreach($players as $item)
                                <option value="/admin/players/{{ $item->id }}"
                                    @if ($player->id == $item->id)
									selected
                                    @endif
                                >{{ $item->name }} {{ $item->year_name}} Scores</option>
							@endforeach
						</select>
						<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-800">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
						</div>
					</div>
				</div>
		</div>
	</div>
	<div>
		<scores :scores="{{ json_encode($scores) }}" type="player"></scores>
	</div>
</div>
@endsection
