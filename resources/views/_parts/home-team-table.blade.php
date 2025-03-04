<table class="table w-full mx-auto table-striped">
    <thead>
        <tr class="course">
            <th class="text-center rounded-tl" colspan="2">Team {{ $teamA->name }}</th>
            <th class="text-center rounded-tr" colspan="2">Team {{ $teamB->name }}</th>
        </tr>
    </thead>
    <tr>
        <td width="40%"><a wire:navigate href="{{ route('player-score', ['player' => $teamA->onePlayer->id]) }}">{{ $teamA->onePlayer->user->name }}</a></td>
        <td width="10%" class="text-center">{{ $teamA->onePlayer->hc_current }}</td>
        <td width="40%"><a wire:navigate href="{{ route('player-score', ['player' => $teamB->onePlayer->id]) }}">{{ $teamB->onePlayer->user->name }}</a></td>
        <td width="10%" class="text-center">{{ $teamB->onePlayer->hc_current }}</td>
    </tr>
    <tr class="border-b border-grey-900">
            @if ($week->quarter == 2)
                <td class=""><a wire:navigate href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
                <td class=""><a wire:navigate href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
            @elseif ($week->quarter == 3)
                <td>
                    @if($teamA->fourPlayer->substitute)
						{{ $teamA->fourPlayer->sub->name }} (S)
					@else
						<div class="flex items-center">
							<div class="h-4 w-4 mr-2 rounded-full {{ $teamA->fourPlayer->tee_selection == 'yellow' ? ' bg-yellow-500 ring-2 ring-grey-900/10 ring-inset ' : ' bg-white  ring-2 ring-grey-900/10 ring-inset ' }}"></div>
							<a wire:navigate href="{{ route('player-score', ['player' => $teamA->fourPlayer->id]) }}">{{ $teamA->fourPlayer->user->name }}</a>
						</div>
					@endif
                </td>
                <td class="text-center">
					@if(!$teamA->fourPlayer->substitute)
						{{ $teamA->fourPlayer->hc_current }}
					@else
						TBD
					@endif
				</td>
               <td>
					@if($teamB->fourPlayer->substitute)
						{{ $teamB->fourPlayer->sub->name }} (S)
					@else
						<div class="flex items-center">
							<div class="h-4 w-4 mr-2 rounded-full {{ $teamB->fourPlayer->tee_selection == 'yellow' ? ' bg-yellow-500 ring-2 ring-grey-900/10 ring-inset ' : ' bg-white  ring-2 ring-grey-900/10 ring-inset ' }}"></div>
							<a wire:navigate href="{{ route('player-score', ['player' => $teamB->fourPlayer->id]) }}">{{ $teamB->fourPlayer->user->name }}</a>
						</div>
					@endif
                </td>
                <td class="text-center">
					@if(!$teamB->fourPlayer->substitute)
						{{ $teamB->fourPlayer->hc_current }}
					@else
						TBD
					@endif
				</td>
            @else
                <td class=""><a wire:navigate href="{{ route('player-score', ['player' => $teamA->twoPlayer->id]) }}">{{ $teamA->twoPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamA->twoPlayer->hc_current }}</td>
                <td class=""><a wire:navigate href="{{ route('player-score', ['player' => $teamB->twoPlayer->id]) }}">{{ $teamB->twoPlayer->user->name }}</a></td>
                <td class="text-center">{{ $teamB->twoPlayer->hc_current }}</td>
            @endif

    </tr>
    <tr>
        @if ($week->quarter == 2 or $week->quarter == 3)
            <td><a wire:navigate href="{{ route('player-score', ['player' => $teamA->twoPlayer->id]) }}">{{ $teamA->twoPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->twoPlayer->hc_current }}</td>
            <td><a wire:navigate href="{{ route('player-score', ['player' => $teamB->twoPlayer->id]) }}">{{ $teamB->twoPlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->twoPlayer->hc_current }}</td>
        @else
            <td><a wire:navigate href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
            <td class=""><a wire:navigate href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
        @endif
    </tr>
    <tr>
        @if ($week->quarter == 3)
            <td><a wire:navigate href="{{ route('player-score', ['player' => $teamA->threePlayer->id]) }}">{{ $teamA->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamA->threePlayer->hc_current }}</td>
            <td class=""><a wire:navigate href="{{ route('player-score', ['player' => $teamB->threePlayer->id]) }}">{{ $teamB->threePlayer->user->name }}</a></td>
            <td class="text-center">{{ $teamB->threePlayer->hc_current }}</td>
        @else
             <td>
                @if($teamA->fourPlayer->substitute)
					{{ $teamA->fourPlayer->sub->name }} (S)
				@else
					<div class="flex items-center">
						<div class="h-4 w-4 mr-2 rounded-full {{ $teamA->fourPlayer->tee_selection == 'yellow' ? ' bg-yellow-500 ring-2 ring-grey-900/10 ring-inset ' : ' bg-white  ring-2 ring-grey-900/10 ring-inset ' }}"></div>
						<a wire:navigate href="{{ route('player-score', ['player' => $teamA->fourPlayer->id]) }}">{{ $teamA->fourPlayer->user->name }}</a>
					</div>
				@endif
            </td>
            <td class="text-center">
				@if(!$teamA->fourPlayer->substitute)
					{{ $teamA->fourPlayer->hc_current }}
				@else
					TBD
				@endif
			</td>
            <td>
				@if($teamB->fourPlayer->substitute)
					{{ $teamB->fourPlayer->sub->name }} (S)
				@else
					<div class="flex items-center">
						<div class="h-4 w-4 mr-2 rounded-full {{ $teamB->fourPlayer->tee_selection == 'yellow' ? ' bg-yellow-500 ring-2 ring-grey-900/10 ring-inset ' : ' bg-white  ring-2 ring-grey-900/10 ring-inset ' }}"></div>
						<a wire:navigate href="{{ route('player-score', ['player' => $teamB->fourPlayer->id]) }}">{{ $teamB->fourPlayer->user->name }}</a>
					</div>
				@endif
            </td>
            <td class="text-center">
				@if(!$teamB->fourPlayer->substitute)
					{{ $teamB->fourPlayer->hc_current }}
				@else
					TBD
				@endif
			</td>
        @endif
    </tr>
</table>
