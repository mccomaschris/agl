<tr>
  <td><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
  <td class="text-center">{{ $player->hc_first }}</td>
  <td class="text-center">{{ $player->hc_second }}</td>
  <td class="text-center">{{ $player->hc_third }}</td>
  <td class="text-center">{{ $player->hc_fourth }}</td>
  <td class="text-center">{{ $player->hc_playoff }}</td>
  <td class="text-center">{{ $player->hc_18 }}</td>
  <td class="text-center">{{ $player->hc_next_year }}</td>
  <td class="text-center">{{ number_format($player->hc_full, 4, '.', ',') }}</td>
  <td class="text-center" width="5%">{{ $player->hc_full_rank }}</td>
    </div>
  </td>
</tr>
