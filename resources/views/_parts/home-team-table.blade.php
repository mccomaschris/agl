<div class="min-w-full">
	<div class="flow-root">
		<div class="">
			<div class="inline-block min-w-full py-2 align-middle">
				<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg">
					<table class="min-w-full divide-y divide-gray-300">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" colspan="2" class="py-3.5 pr-3 text-left text-sm font-semibold text-gray-900 pl-4">Team {{ $teamA->name }}</th>
								<th scope="col" colspan="2" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Team {{ $teamB->name }}</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-gray-200">
							<tr class="bg-gray-50/50">
								<td class="w-[40%] px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->onePlayer->id]) }}">{{ $teamA->onePlayer->user->name }}</a></td>
								<td class="text-center w-[10%] px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 border-r border-zinc-200">{{ $teamA->onePlayer->hc_current }}</td>
								<td class="w-[40%] px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->onePlayer->id]) }}">{{ $teamB->onePlayer->user->name }}</a></td>
								<td class="text-center w-[10%] px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">{{ $teamB->onePlayer->hc_current }}</td>
							</tr>
							<tr class="border-b border-zinc-500">
								@if ($week->quarter == 2)
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 border-r border-zinc-200">{{ $teamA->threePlayer->hc_current }}</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">{{ $teamB->threePlayer->hc_current }}</td>
								@elseif ($week->quarter == 3)
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">
										@if($teamA->fourPlayer->substitute)
											{{ $teamA->fourPlayer->sub->name }} (S)
										@else
											<div class="flex items-center">
												<x-tee :color="$teamA->fourPlayer->tee_selection" />
												<a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->fourPlayer->id]) }}">{{ $teamA->fourPlayer->user->name }}</a>
											</div>
										@endif
									</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 text-center">
										@if(!$teamA->fourPlayer->substitute)
											{{ $teamA->fourPlayer->hc_current }}
										@else
											TBD
										@endif
									</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">
										@if($teamB->fourPlayer->substitute)
											{{ $teamB->fourPlayer->sub->name }} (S)
										@else
											<div class="flex items-center">
												<x-tee :color="$teamB->fourPlayer->tee_selection" />
												<a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->fourPlayer->id]) }}">{{ $teamB->fourPlayer->user->name }}</a>
											</div>
										@endif
									</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 text-center">
										@if(!$teamB->fourPlayer->substitute)
											{{ $teamB->fourPlayer->hc_current }}
										@else
											TBD
										@endif
									</td>
								@else
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->twoPlayer->id]) }}">{{ $teamA->twoPlayer->user->name }}</a></td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 text-center border-r border-zinc-200">{{ $teamA->twoPlayer->hc_current }}</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->twoPlayer->id]) }}">{{ $teamB->twoPlayer->user->name }}</a></td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 text-center">{{ $teamB->twoPlayer->hc_current }}</td>
								@endif
							</tr>
							<tr class="bg-gray-50/50">
								@if ($week->quarter == 2 or $week->quarter == 3)
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->twoPlayer->id]) }}">{{ $teamA->twoPlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 border-r border-zinc-200">{{ $teamA->twoPlayer->hc_current }}</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->twoPlayer->id]) }}">{{ $teamB->twoPlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">{{ $teamB->twoPlayer->hc_current }}</td>
								@else
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 border-r border-zinc-200">{{ $teamA->threePlayer->hc_current }}</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">{{ $teamB->threePlayer->hc_current }}</td>
								@endif
							</tr>
							<tr>
								@if ($week->quarter == 3)
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 border-r border-zinc-200">{{ $teamA->threePlayer->hc_current }}</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500"><a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">{{ $teamB->threePlayer->hc_current }}</td>
								@else
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">
										@if($teamA->fourPlayer->substitute)
											{{ $teamA->fourPlayer->sub->name }} (S)
										@else
											<div class="flex items-center">
												<x-tee :color="$teamA->fourPlayer->tee_selection" />
												<a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamA->fourPlayer->id]) }}">{{ $teamA->fourPlayer->user->name }}</a>
											</div>
										@endif
									</td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500 border-r border-zinc-200">
										@if(!$teamA->fourPlayer->substitute)
											{{ $teamA->fourPlayer->hc_current }}
										@else
											TBD
										@endif
									</td>
									<td class="px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">
										@if($teamB->fourPlayer->substitute)
											{{ $teamB->fourPlayer->sub->name }} (S)
										@else
											<div class="flex items-center">
												<x-tee :color="$teamB->fourPlayer->tee_selection" />
												<a class="font-semibold underline hover:no-underline" wire:navigate href="{{ route('player-score', ['player' => $teamB->fourPlayer->id]) }}">{{ $teamB->fourPlayer->user->name }}</a>
											</div>
										@endif
									</td>
									<td class="text-center px-3 py-4 text-sm lg:whitespace-nowrap text-gray-500">
										@if(!$teamB->fourPlayer->substitute)
											{{ $teamB->fourPlayer->hc_current }}
										@else
											TBD
										@endif
									</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
