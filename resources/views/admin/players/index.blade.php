@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="font-bold text-3xl">Players</h1>
        <a href="/admin/players/create" class="px-6 py-3 rounded bg-green-500 text-white text-sm font-bold hover:text-white hover:bg-green-600">
			<span>Create</span>
			<span class="hidden md:inline">Player</span>
		</a>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                    <th class="px-6 pt-6 pb-4">Year</th>
                    <th class="px-6 pt-6 pb-4">Position</th>
                    <th class="px-6 pt-6 pb-4" colspan="2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($years as $year)
                    @foreach($year->players as $player)
                        <tr class="hover:bg-zinc-100 focus-within:bg-zinc-lightest group text-zinc-500">
                            <td class="border-t px-6 py-4  group-hover:text-green-500 ">
                                <div class="flex justify-between items-center">
                                    <a href="/admin/players/{{ $player->id }}/edit">{{ $player->user->name }}</a>
                                </div>
                            </td>
                            <td class="border-t px-6 py-4 group-hover:text-green-500">{{ $year->name }} Season Team {{ $player->team->name }}</td>
                            <td class="border-t px-6 py-4 group-hover:text-green-500">#{{ $player->position }} player</td>
                            <td class="border-t px-6 py-4 group-hover:text-green-500">
                                @if($player->substitute)
                                    <span class="pill pill-red">Substitute</span>
                                @elseif($player->on_leave)
                                    <span class="pill pill-grey">On Leave</span>
                                @endif
                            </td>
                            <td class="border-t w-px">
                                <a href="/admin/players/{{ $player->id }}/edit" class="text-zinc-500 group-hover:text-green-500 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block w-6 h-6 fill-current" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
