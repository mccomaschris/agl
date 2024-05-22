<table class="table w-full table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center rounded-tl">Rk</th>
            <th class="text-left">Player</th>
            <th class="text-center">W</th>
            <th class="text-center">L</th>
            <th class="text-center">T</th>
            <th class="text-center rounded-tr">Pts</th>
        </tr>
    </thead>
    @foreach ($year->playerStandings(35) as $player)
        <tr>
            <td class="text-center">{{ $player->points_rank }}</td>
            <td class="font-semibold"><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
            <td class="text-center">{{ $player->won }}</td>
            <td class="text-center">{{ $player->lost }}</td>
            <td class="text-center">{{ $player->tied }}</td>
            <td class="text-center"><strong class="text-grey-900">{{ $player->points }}</strong></td>
        </tr>
    @endforeach
</table>
