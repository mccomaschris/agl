<?php

use App\Jobs\UpdateHandicaps;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateRoundStats;
use App\Models\Player;
use App\Models\Score;
use App\Models\Year;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public $scoreId;

    public $isOdd;

    public Score $score;

    public $gross;

    public $opponentScoreId = null;

    public array $opponentHoles = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0];

    public $myHandicap = 0;

    public $opponentHandicap = 0;

    public $displayHandicap = 0;

    #[Validate('integer|nullable')]
    public $absent;

    #[Validate('integer|nullable')]
    public $weekly_winner;

    #[Validate('integer|nullable')]
    public $substitute_id;

    #[Validate('integer|nullable')]
    public $hole_1;

    #[Validate('integer|nullable')]
    public $hole_2;

    #[Validate('integer|nullable')]
    public $hole_3;

    #[Validate('integer|nullable')]
    public $hole_4;

    #[Validate('integer|nullable')]
    public $hole_5;

    #[Validate('integer|nullable')]
    public $hole_6;

    #[Validate('integer|nullable')]
    public $hole_7;

    #[Validate('integer|nullable')]
    public $hole_8;

    #[Validate('integer|nullable')]
    public $hole_9;

    #[Validate('integer|nullable')]
    public $points;

    public function mount($scoreId, $isOdd)
    {
        $this->score = Score::find($scoreId);
        $this->isOdd = $isOdd;

        $this->absent = (bool) $this->score->absent;
        $this->weekly_winner = (bool) $this->score->weekly_winner;
        $this->substitute_id = (bool) $this->score->substitute_id;
        $this->hole_1 = intval($this->score->hole_1);
        $this->hole_2 = intval($this->score->hole_2);
        $this->hole_3 = intval($this->score->hole_3);
        $this->hole_4 = intval($this->score->hole_4);
        $this->hole_5 = intval($this->score->hole_5);
        $this->hole_6 = intval($this->score->hole_6);
        $this->hole_7 = intval($this->score->hole_7);
        $this->hole_8 = intval($this->score->hole_8);
        $this->hole_9 = intval($this->score->hole_9);
        $this->points = intval($this->score->points);

        $weekOrder = $this->score->week->week_order;
        $hcField = match (true) {
            $weekOrder <= 5 => 'hc_first',
            $weekOrder <= 10 => 'hc_second',
            $weekOrder <= 15 => 'hc_third',
            default => 'hc_fourth',
        };

        $this->myHandicap = $this->score->player->$hcField;
        $this->displayHandicap = $this->myHandicap;

        $opponentPlayer = $this->score->opponent();
        if ($opponentPlayer) {
            $this->opponentHandicap = $opponentPlayer->$hcField;
            $opponentScore = Score::where('foreign_key', $this->score->foreign_key)
                ->where('player_id', $opponentPlayer->id)
                ->where('score_type', 'weekly_score')
                ->first();
            if ($opponentScore) {
                $this->opponentScoreId = $opponentScore->id;
                for ($i = 1; $i <= 9; $i++) {
                    $this->opponentHoles[$i] = intval($opponentScore->{"hole_$i"});
                }
            }
        }

        $this->calculateGross();
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'hole_')) {
            $this->calculateGross();
        }
    }

    public function calculateGross()
    {
        $this->gross =
            (int) $this->hole_1 +
            (int) $this->hole_2 +
            (int) $this->hole_3 +
            (int) $this->hole_4 +
            (int) $this->hole_5 +
            (int) $this->hole_6 +
            (int) $this->hole_7 +
            (int) $this->hole_8 +
            (int) $this->hole_9;
    }

    public function save()
    {
        $this->score->hole_1 = $this->hole_1;
        $this->score->hole_2 = $this->hole_2;
        $this->score->hole_3 = $this->hole_3;
        $this->score->hole_4 = $this->hole_4;
        $this->score->hole_5 = $this->hole_5;
        $this->score->hole_6 = $this->hole_6;
        $this->score->hole_7 = $this->hole_7;
        $this->score->hole_8 = $this->hole_8;
        $this->score->hole_9 = $this->hole_9;
        $this->score->points = $this->points;
        $this->score->weekly_winner = $this->weekly_winner;
        $this->score->absent = $this->absent;
        $this->score->substitute_id = $this->substitute_id;

        $this->score->save();

        $player = Player::find($this->score->player_id);
        $year = Year::find($player->year_id);

        UpdateRoundStats::withChain([
            new UpdatePlayerStats($this->score->player),
            new UpdateHandicaps($this->score->player),
        ])->dispatch($this->score);

        Flux::toast(
            heading: 'Score updated.',
            text: $player->user->name.' score has been updated.',
            variant: 'success',
        );
    }

    public function with(): array
    {
        return [
            'score' => $this->score,
            'gross' => $this->gross,
            'hole_1' => $this->hole_1,
            'hole_2' => $this->hole_2,
            'hole_3' => $this->hole_3,
            'hole_4' => $this->hole_4,
            'hole_5' => $this->hole_5,
            'hole_6' => $this->hole_6,
            'hole_7' => $this->hole_7,
            'hole_8' => $this->hole_8,
            'hole_9' => $this->hole_9,
            'points' => $this->points,
            'absent' => $this->absent,
            'weekly_winner' => $this->weekly_winner,
            'substitute_id' => $this->substitute_id,
            'displayHandicap' => $this->displayHandicap,
        ];
    }
}; ?>

<x-table.tr-body
    class="{{ $isOdd ? '' : 'not-last:border-b-4! border-zinc-500' }}"
    x-data="{myH:[{{ (int)$hole_1 }},{{ (int)$hole_2 }},{{ (int)$hole_3 }},{{ (int)$hole_4 }},{{ (int)$hole_5 }},{{ (int)$hole_6 }},{{ (int)$hole_7 }},{{ (int)$hole_8 }},{{ (int)$hole_9 }}],oppH:[{{ (int)$opponentHoles[1] }},{{ (int)$opponentHoles[2] }},{{ (int)$opponentHoles[3] }},{{ (int)$opponentHoles[4] }},{{ (int)$opponentHoles[5] }},{{ (int)$opponentHoles[6] }},{{ (int)$opponentHoles[7] }},{{ (int)$opponentHoles[8] }},{{ (int)$opponentHoles[9] }}],myHc:{{ (int)$myHandicap }},oppHc:{{ (int)$opponentHandicap }},scoreId:{{ (int)$scoreId }},oppScoreId:{{ (int)($opponentScoreId ?? 0) }},si:[8,2,6,3,4,9,5,7,1],init(){window.addEventListener('league-hole-updated',(e)=>{if(e.detail.scoreId===this.oppScoreId){this.oppH[e.detail.hole]=e.detail.value;}});},updateHole(h,v){let n=parseInt(v)||0;this.myH[h]=n;window.dispatchEvent(new CustomEvent('league-hole-updated',{detail:{scoreId:this.scoreId,hole:h,value:n}}));},isFlag(i){let m=this.myH[i]||0,o=this.oppH[i]||0;return m>0&&o>0&&m>o+2;},winner(i){let m=this.myH[i]||0,o=this.oppH[i]||0;if(!m||!o)return null;let d=this.myHc-this.oppHc,s=this.si[i],mS=d>0?(d>=s?1:0)+(d>=9+s?1:0):0,oS=d<0?(Math.abs(d)>=s?1:0)+(Math.abs(d)>=9+s?1:0):0;return m-mS<o-oS?'win':m-mS>o-oS?'lose':'tie';},cellStyle(i){if(this.isFlag(i))return 'background-color:#dc2626';let w=this.winner(i);if(w==='win')return 'background-color:#dcfce7';if(w==='lose')return 'background-color:#fee2e2';if(w==='tie')return 'background-color:#fef3c7';return '';}}"
>
	<x-table.td id="{{ $score->id }}" class="text-sm! pl-2! text-left! whitespace-normal!">
		<a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player->user->name }}</a>
        <span class="text-xs text-zinc-400 ml-1">({{ $displayHandicap }})</span>
        @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:checkbox class="mx-auto!" wire:model.live="absent" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:checkbox class="mx-auto!" wire:model="weekly_winner" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:checkbox class="mx-auto!" wire:model="substitute_id" />
	</x-table.td>

    @for ($i = 1; $i <= 9; $i++)
    <x-table.td
        class="text-sm! p-0!"
        x-bind:style="cellStyle({{ $i - 1 }})"
    >
        <div class="px-1 py-4" @input="updateHole({{ $i - 1 }}, $event.target.value)">
            <flux:input
                pattern="[0-9]*"
                inputmode="numeric"
                type="number"
                :disabled="$absent"
                wire:model.live="hole_{{ $i }}"
                class="w-20!"
                onfocus="this.select()"
            />
        </div>
    </x-table.td>
    @endfor

    <x-table.td class="text-sm!">{{ number_format($gross, 0) }}</x-table.td>
    <x-table.td class="text-sm!">
		<flux:select wire:model="points" wire:blur="save">
			<flux:select.option value=""></flux:select.option>
			<flux:select.option value="0">0</flux:select.option>
			<flux:select.option value="1">1</flux:select.option>
			<flux:select.option value="2">2</flux:select.option>
		</flux:select>
    </x-table.td>

    <x-table.td class="text-sm!">
		<flux:button wire:click="save" icon="check-circle" />
    </x-table.td>
</x-table.tr-body>

