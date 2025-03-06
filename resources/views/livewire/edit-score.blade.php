<tr>
    <td id="{{ $score->id }}" class="border-t px-2 py-4 text-sm text-left"><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player->user->name }}</a>
        @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
		<div class="text-xs">{{ $score->id }}</div>
    </td>
    <td class="border-t px-2 py-4 text-sm text-center"><input type="checkbox" wire:model="absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input type="checkbox" wire:model="weekly_winner" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input type="checkbox" wire:model="substitute_id" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_1" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_2" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_3" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_4" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_5" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_6" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_7" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_8" :disabled="$wire.absent" /></td>
    <td class="border-t px-2 py-4 text-sm text-center"><input pattern="[0-9]*" type="number" class="w-20 text-xs" wire:model="hole_9" :disabled="$wire.absent" wire:blur="countGross" /></td>
    <td class="border-t px-2 py-4 text-sm text-center">{{ number_format($gross, 0) }}</td>
    <td class="border-t px-2 py-4 text-sm text-center">
        <select wire:model="points" wire:blur="save" class="block appearance-none w-14 bg-zinc-100 border border-zinc-300 text-zinc-600 p-2 rounded" name="points">
            <option value=""></option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </td>

    <td class="border-t px-2 py-4 text-sm text-center">
        <button wire:click="save" class="focus:outline-none text-zinc-400 hover:text-green-500" tabindex="-1" wire:loading.remove>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-6 w-6"><path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"></path></svg>
        </button>
        <div class="text-center mx-auto w-full flex items-center justify-center" wire:loading>
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </td>
</tr>
