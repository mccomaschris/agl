<x-table>
	<x-table.thead>
		<x-table.tr>
			<x-table.th>Week</x-table.th>
			<x-table.th>1</x-table.th>
			<x-table.th>2</x-table.th>
			<x-table.th>3</x-table.th>
			<x-table.th>4</x-table.th>
			<x-table.th>5</x-table.th>
			<x-table.th>6</x-table.th>
			<x-table.th>7</x-table.th>
			<x-table.th>8</x-table.th>
			<x-table.th>9</x-table.th>
			<x-table.th>10</x-table.th>
			<x-table.th>11</x-table.th>
			<x-table.th>12</x-table.th>
			<x-table.th>13</x-table.th>
			<x-table.th>14</x-table.th>
			<x-table.th>15</x-table.th>
			<x-table.th>16</x-table.th>
			<x-table.th>17</x-table.th>
			<x-table.th>18</x-table.th>
			<x-table.th>19</x-table.th>
			<x-table.th>20</x-table.th>
			<x-table.th>Avg</x-table.th>
			<x-table.th>NetAvg</x-table.th>
			<x-table.th>Low</x-table.th>
			<x-table.th>High</x-table.th>
			<x-table.th>LowNet</x-table.th>
			<x-table.th>Eg</x-table.th>
			<x-table.th>Br</x-table.th>
			<x-table.th>Par</x-table.th>
			<x-table.th>Bg</x-table.th>
			<x-table.th>DblBg+</x-table.th>
		</x-table.tr>
	</x-table.thead>
	<x-table.tbody>
		@foreach ($players as $player)
			<x-table.tr-body>
				<x-table.td><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></x-table.td>
				@foreach ($player->weekly_scores as $score)
					@if ($score->absent)
						<x-table.td class="bg-zinc-900! text-white! font-bold text-center">A</x-table.td>
					@elseif ($score->injury)
						<x-table.td class="bg-zinc-900! text-white! font-bold text-center">I</x-table.td>
					@elseif ($score->week->back_nine)
						<x-table.td>-</x-table.td>
					@else
						<x-table.td>{{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }} @if($score->substitute_id > 0)<span class="font-bold">(S)</span>@endif</x-table.td>
					@endif
				@endforeach
				<x-table.td>{{ number_format($player->gross_average, 1, '.', ',') }}</x-table.td>
				<x-table.td>{{ number_format($player->net_average, 1, '.', ',') }}</x-table.td>
				<x-table.td>{{ $player->low_gross }}</x-table.td>
				<x-table.td>{{ $player->high_gross }}</x-table.td>
				<x-table.td>{{ $player->low_net }}</x-table.td>
				<x-table.td class="bg-yellow-200! text-yellow-800!">{{ $player->season_avg->eagle }}</x-table.td>
				<x-table.td class="bg-green-200! text-green-800!">{{ $player->season_avg->birdie }}</x-table.td>
				<x-table.td>{{ $player->season_avg->par }}</x-table.td>
				<x-table.td class="bg-red-200! text-red-800!">{{ $player->season_avg->bogey }}</x-table.td>
				<x-table.td class="bg-sky-200! text-sky-800!">{{ $player->season_avg->double_bogey }}</x-table.td>
			</x-table.tr-body>
		@endforeach
	</x-table.tbody>
</x-table>
