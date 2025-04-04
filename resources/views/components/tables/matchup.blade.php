@php
    // Define player order based on the quarter
    $playerOrders = [
        1 => ['onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer'],
        2 => ['onePlayer', 'threePlayer', 'twoPlayer', 'fourPlayer'],
        3 => ['onePlayer', 'fourPlayer', 'twoPlayer', 'threePlayer'],
        4 => ['onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer'],
    ];

    // Get the correct player order for the current quarter
    $playerKeys = $playerOrders[$week->quarter] ?? $playerOrders[1]; // Default to Quarter 1 if undefined
@endphp

<x-table>
    <x-table.thead>
        <x-table.tr>
            <x-table.th colspan="2" class="text-center!">
                Team {{ $teamA->name }}
            </x-table.th>
            <x-table.th colspan="2">
                Team {{ $teamB->name }}
            </x-table.th>
        </x-table.tr>
    </x-table.thead>

    <x-table.tbody>
        @foreach ($playerKeys as $currentPlayerKey)
            @php
                $rowBgClass = $loop->odd ? 'bg-zinc-50 dark:bg-zinc-800!' : 'border-b-4 border-zinc-500 dark:bg-zinc-700!';
            @endphp

            <x-table.tr-body class="{{ $rowBgClass }}">
                @foreach (['teamA', 'teamB'] as $team)
                    @php
                        $player = $$team->$currentPlayerKey;
                        $isSub = $player->substitute ?? false;
                    @endphp

                    <x-table.td class="w-[40%] border-r-0! pl-2! pr-2!">
                        @if ($isSub)
                            {{ $player->sub->name ?? '' }} (S)
                        @else
                            <div class="flex items-center">
                                @if ($currentPlayerKey === 'fourPlayer')
                                    <x-tee :color="$player->tee_selection" />
                                @endif
                                <a class="font-semibold underline hover:no-underline dark:text-green-400!" wire:navigate href="{{ route('player-score', ['player' => $player->id]) }}">
                                    {{ $player->user->name }}
                                </a>
                            </div>
                        @endif
                    </x-table.td>

                    <x-table.td class="text-center w-[10%] {{ $team === 'teamA' ? 'border-r border-zinc-200' : '' }} dark:text-zinc-200!">
                        {{ $isSub ? '-' : $player->hc_current }}
                    </x-table.td>
                @endforeach
            </x-table.tr-body>
        @endforeach
    </x-table.tbody>
</x-table>
