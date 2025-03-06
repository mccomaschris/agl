@props(['week', 'teamA', 'teamB' ])

<table class="table w-full mx-auto table-striped">
    <thead>
        <tr class="course">
            <th class="text-center rounded-tl" colspan="2">Team {{ $teamA->name }}</th>
            <th class="text-center rounded-tr" colspan="2">Team {{ $teamB->name }}</th>
        </tr>
    </thead>
    <tr>
        <td width="40%"><a href="{{ route('player-score', ['player' => $teamA->onePlayer->id]) }}">{{ $teamA->onePlayer->user->name }}</a></td>
        <td width="10%" class="text-center">{{ $teamA->onePlayer->hc_current }}</td>
        <td width="40%"><a href="{{ route('player-score', ['player' => $teamB->onePlayer->id]) }}">{{ $teamB->onePlayer->user->name }}</a></td>
        <td width="10%" class="text-center">{{ $teamB->onePlayer->hc_current }}</td>
    </tr>
    <tr class="border-b border-zinc-900">
            @if ($week->quarter == 2)
                <td class=""><a href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
                <td class=""><a href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
            @elseif ($week->quarter == 3)
                <td>
                    <div class="flex items-center">
                        <div class="h-4 w-4 border border-black mr-2 {{ $teamA->fourPlayer->tee_selection == 'yellow' ? ' text-yellow ' : ' text-white ' }}"></div>
                        <a href="{{ route('player-score', ['player' => $teamA->fourPlayer->id]) }}">{{ $teamA->fourPlayer->user->name }}</a>
                    </div>
                </td>
                <td class="text-center">{{ $teamA->fourPlayer->hc_current }}</td>
               <td>
                <div class="flex items-center">
                    <div class="h-4 w-4 border border-black mr-2 {{ $teamB->fourPlayer->tee_selection == 'yellow' ? ' text-yellow ' : ' text-white ' }}"></div>
                        <a href="{{ route('player-score', ['player' => $teamB->fourPlayer->id]) }}">{{ $teamB->fourPlayer->user->name }}</a>
                    </div>
                </td>
                </div>
            </td>
                <td class="text-center">{{ $teamB->fourPlayer->hc_current }}</td>
            @else
                <td class=""><a href="{{ route('player-score', ['player' => $teamA->twoPlayer->id]) }}">{{ $teamA->twoPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->twoPlayer->hc_current }}</td>
                <td class=""><a href="{{ route('player-score', ['player' => $teamB->twoPlayer->id]) }}">{{ $teamB->twoPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->twoPlayer->hc_current }}</td>
            @endif

    </tr>
    <tr>
        @if ($week->quarter == 2 or $week->quarter == 3)
            <td><a href="{{ route('player-score', ['player' => $teamA->twoPlayer->id]) }}">{{ $teamA->twoPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->twoPlayer->hc_current }}</td>
            <td><a href="{{ route('player-score', ['player' => $teamB->twoPlayer->id]) }}">{{ $teamB->twoPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->twoPlayer->hc_current }}</td>
        @else
            <td><a href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
            <td class=""><a href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
        @endif
    </tr>
    <tr>
        @if ($week->quarter == 3)
            <td><a href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
            <td class=""><a href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
        @else
             <td>
                <div class="flex items-center">
                    <div class="h-4 w-4 border border-black mr-2 {{ $teamA->fourPlayer->tee_selection == 'yellow' ? ' text-yellow ' : ' text-white ' }}"></div>
                    <a href="{{ route('player-score', ['player' => $teamA->fourPlayer->id]) }}">{{ $teamA->fourPlayer->user->name }}</a>
                </div>
            </td>
            <td class="text-center">{{ $teamA->fourPlayer->hc_current }}</td>
            <td>
                <div class="flex items-center">
                <div class="h-4 w-4 border border-black mr-2 {{ $teamB->fourPlayer->tee_selection == 'yellow' ? ' text-yellow ' : ' text-white ' }}"></div>
                    <a href="{{ route('player-score', ['player' => $teamB->fourPlayer->id]) }}">{{ $teamB->fourPlayer->user->name }}</a>
                </div>
            </td>
            <td class="text-center">{{ $teamB->fourPlayer->hc_current }}</td>
        @endif
    </tr>
</table>
