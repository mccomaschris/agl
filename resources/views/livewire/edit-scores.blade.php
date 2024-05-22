<div>
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>

    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>

		<div class="relative">
            <select onchange="location = this.value;">
                @foreach ($weeks as $item)
                <option value="/scores/week/{{ $item->id }}"
                    @if ($week->id == $item->id)
                    selected
                    @endif
                    >Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</option>
                    @endforeach
			</select>
        </div>
    </div>

    <div class="w-full mb-6">
        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #1</h3>

		<div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
				<x-edit-score-head />

                @foreach ($matchup_1 as $score)
					<livewire:edit-score :scoreId="$score->id" :key="$score->id" />
                @endforeach
            </table>
        </div>

        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #2</h3>

		<div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                <x-edit-score-head />

                @foreach ($matchup_2 as $score)
					<livewire:edit-score :scoreId="$score->id" :key="$score->id" />
                @endforeach
            </table>
        </div>

        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #3</h3>

		<div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                <x-edit-score-head />

                @foreach ($matchup_3 as $score)
					<livewire:edit-score :scoreId="$score->id" :key="$score->id" />
                @endforeach
            </table>
        </div>
    </div>
</div>
