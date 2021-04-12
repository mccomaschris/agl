<div class="large-table">
    <table class="table w-full mt-6">
        <thead>
            <tr>
                <th>Hole</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>TOT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="w-full flex items-center justify-between">
                        <span>{{ $score->player->user->first_name() }}<span>
                        <span class="ml-5 font-semibold text-green-500"></span>
                    </div>
                </td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 8 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_1" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 2 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_2" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 6 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_3" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 3 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_4" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 4 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_5" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 9 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_6" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 5 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_7" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 7 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_8" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $score->handicap - $opp_score->handicap >= 1 ? ' bg-green-500 ' : '' }}"><input wire:model="hole_9" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="text-right font-semibold">{{ number_format($score->gross) }}</td>
            </tr>
            <tr>
                <td>
                    <div class="w-full flex items-center justify-between">
                        <span>{{ $opp_score->player->user->first_name() }}<span>
                        <span class="ml-5 font-semibold text-green-500">{{ $opp_score->handicap }}</span>
                    </div>
                </td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 8 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_1" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 2 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_2" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 6 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_3" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 3 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_4" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 4 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_5" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 9 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_6" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 5 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_7" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 7 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_8" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="{{ $opp_score->handicap - $score->handicap >= 1 ? ' bg-green-500 ' : '' }}"><input wire:model="opp_hole_9" type="number" pattern="[0-9]*" class="form-input" onclick="this.select()"></td>
                <td class="text-right font-semibold">{{ number_format($opp_score->gross) }}</td>
            </tr>
            {{-- <tr>
                <td>WIN</td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_1 < $opp_score->hole_1)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_1 > $opp_score->hole_1)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_2 < $opp_score->hole_2)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_2 > $opp_score->hole_2)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_3 < $opp_score->hole_3)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_3 > $opp_score->hole_3)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_4 < $opp_score->hole_4)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_4 > $opp_score->hole_4)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_5 < $opp_score->hole_5)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_5 > $opp_score->hole_5)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_6 < $opp_score->hole_6)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_6 > $opp_score->hole_6)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_6 < $opp_score->hole_6)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_6 > $opp_score->hole_6)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_8 < $opp_score->hole_8)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_8 > $opp_score->hole_8)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center font-green-500 font-semibold">
                    @if ($score->hole_9 < $opp_score->hole_9)
                        {{ $score->player->user->first_name()[0] }}
                    @elseif ($score->hole_9 > $opp_score->hole_9)
                        {{ $opp_score->player->user->first_name()[0] }}
                    @else
                        -
                    @endif
                </td>
                <td></td>
            </tr> --}}
            <tr>
                <td></td>
                <td colspan="9">
                    <button class="w-full btn btn-green text-center my-2" wire:click="save" wire:loading.remove>Save Scores</button>
                    <button class="w-full btn btn-green text-center my-2 loader" wire:click="save" wire:loading></button>
                </td>
               <td></td>
            </tr>
        </tbody>
    </table>
    <div class="w-full flex justify-center items-center text-green-500 mt-6"
    x-data="{ open: false }"
                     x-init="
                         @this.on('notify-saved', () => {
                             if (open === false) setTimeout(() => { open = false }, 2500);
                             open = true;
                         })
                     "
                     x-show.transition.out.duration.1000ms="open"
                     style="display: none;"
                     >
        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/></svg>
        <span class="font-semibold ml-2">Scores Saved!</span>
        </div>
</div>
