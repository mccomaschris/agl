<tr>
    <td><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player->user->name }}</a>
        @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
    </td>
    <td class="text-center"><input type="checkbox" wire:model="score.absent" /></td>
    <td class="text-center"><input type="checkbox" wire:model="score.weekly_winner" /></td>
    <td class="text-center"><input type="checkbox" wire:model="score.substitute_id" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_1" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_2" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_3" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_4" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_5" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_6" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_7" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model.defer="score.hole_8" /></td>
    <td class="text-center"><input type="text" class="w-10 text-xs" wire:model="score.hole_9" wire:blur="countGross" /></td>
    <td class="text-center">
        <select wire:model="score.points" wire:blur="save" class="block appearance-none w-full bg-grey-100 border border-grey-300 text-grey-600 p-2 rounded" name="points">
            <option value=""></option>
            <option value="0" selected="">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </td>
    <td class="text-center"><input class="w-10 text-xs" type="text" name="gross" id="gross" wire:model="gross" disabled></td>
    <td class="text-center">
        <button wire:click="save" class="focus:outline-none text-grey-400 hover:text-green-500" tabindex="-1" wire:loading.remove>
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
