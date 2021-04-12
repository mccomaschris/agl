<table class="table w-full mx-auto">
    <thead>
        <tr class="course">
            <th class="text-center" colspan="2">Team {{ $teamA->name }}</th>
            <th class="text-center" colspan="2">Team {{ $teamB->name }}</th>
        </tr>
    </thead>
    <tr>
        <td width="40%">
            @if ( $teamA->onePlayer->id == 145 )
                Danny Freeman
            @else
                <a href="/scores/{{ $teamA->onePlayer->id }}">{{ $teamA->onePlayer->user->name }}</a>
            @endif
        </td>
        <td width="10%" class="text-center">
            @if ( $teamA->onePlayer->id == 145 )
                5
            @else
                {{ $teamA->onePlayer->hc_current }}
            @endif
        </td>
        <td width="40%">
            @if ( $teamB->onePlayer->id == 145 )
                Danny Freeman
            @else
                <a href="/scores/{{ $teamB->onePlayer->id }}">{{ $teamB->onePlayer->user->name }}</a>
            @endif
        </td>
        <td width="10%" class="text-center">
            @if ( $teamA->onePlayer->id == 145 )
                5
            @else
                {{ $teamB->onePlayer->hc_current }}
            @endif
        </td>
    </tr>
    <tr style="border-bottom: 4px solid #333;">
            @if ($quarter == 2)
                <td><a href="/scores/{{ $teamA->threePlayer->id }}">{{ $teamA->threePlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
                <td><a href="/scores/{{ $teamB->threePlayer->id }}">{{ $teamB->threePlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
            @elseif ($quarter == 3)
                <td><a href="/scores/{{ $teamA->fourPlayer->id }}">{{ $teamA->fourPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->fourPlayer->hc_current }}</td>
                <td><a href="/scores/{{ $teamB->fourPlayer->id }}">{{ $teamB->fourPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->fourPlayer->hc_current }}</td>
            @else
                <td><a href="/scores/{{ $teamA->twoPlayer->id }}">{{ $teamA->twoPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->twoPlayer->hc_current }}</td>
                <td><a href="/scores/{{ $teamB->twoPlayer->id }}">{{ $teamB->twoPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->twoPlayer->hc_current }}</td>
            @endif

    </tr>
    <tr>
        @if ($quarter == 2 or $quarter == 3)
            <td><a href="/scores/{{ $teamA->twoPlayer->id }}">{{ $teamA->twoPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->twoPlayer->hc_current }}</td>
            <td><a href="/scores/{{ $teamB->twoPlayer->id }}">{{ $teamB->twoPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->twoPlayer->hc_current }}</td>
        @else
            <td><a href="/scores/{{ $teamA->threePlayer->id }}">{{ $teamA->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
            <td><a href="/scores/{{ $teamB->threePlayer->id }}">{{ $teamB->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
        @endif
    </tr>
    <tr>
        @if ($quarter == 3)
            <td><a href="/scores/{{ $teamA->threePlayer->id }}">{{ $teamA->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
            <td><a href="/scores/{{ $teamB->threePlayer->id }}">{{ $teamB->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
        @else
            <td><a href="/scores/{{ $teamA->fourPlayer->id }}">{{ $teamA->fourPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->fourPlayer->hc_current }}</td>
            <td><a href="/scores/{{ $teamB->fourPlayer->id }}">{{ $teamB->fourPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->fourPlayer->hc_current }}</td>
        @endif
    </tr>
</table>