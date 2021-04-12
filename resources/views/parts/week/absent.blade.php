<td>Team #{{ $score->team_name }}</td>
<td><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a></td>
    <td></td>
<td class="text-center absent_row" colspan="19"><strong>ABSENT</strong></td>