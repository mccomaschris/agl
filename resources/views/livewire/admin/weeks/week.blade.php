<?php

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Year;
use App\Models\Week;

new class extends Component {
	public Week $week;

	public $year_id = '';
	public $week_order = '';
	public $week_date = '';
	public $side_games = '';
	public $a_first_id = '';
	public $a_second_id = '';
	public $b_first_id = '';
	public $b_second_id = '';
	public $c_first_id = '';
	public $c_second_id = '';
	public $ignore_scores = false;
	public $back_nine = false;

	public function rules()
    {
        return [
            'year_id' => ['required'],
            'week_order' => ['required'],
			'week_date' => ['required', 'date'],
			'side_games' => ['required'],
			'a_first_id' => ['required'],
			'a_second_id' => ['required'],
			'b_first_id' => ['required'],
			'b_second_id' => ['required'],
			'c_first_id' => ['required'],
			'c_second_id' => ['required'],
			'ignore_scores' => ['nullable', 'boolean'],
			'back_nine' => ['nullable', 'boolean'],
		];
    }

    public function mount()
    {
        $this->year_id = $this->week->year_id;
		$this->week_order = $this->week->week_order;
		$this->week_date = $this->week->week_date;
		$this->side_games = $this->week->side_games;
		$this->a_first_id = $this->week->a_first_id;
		$this->a_second_id = $this->week->a_second_id;
		$this->b_first_id = $this->week->b_first_id;
		$this->b_second_id = $this->week->b_second_id;
		$this->c_first_id = $this->week->c_first_id;
		$this->c_second_id = $this->week->c_second_id;
		$this->ignore_scores = $this->week->ignore_scores;
		$this->back_nine = $this->week->back_nine;
    }

    public function edit()
    {
        $this->modal('week-edit')->show();
    }

    public function update()
    {
        $this->validate();

		$this->week->update([
			'year_id' => $this->year_id,
			'week_order' => $this->week_order,
			'week_date' => $this->week_date,
			'side_games' => $this->side_games,
			'a_first_id' => $this->a_first_id,
			'a_second_id' => $this->a_second_id,
			'b_first_id' => $this->b_first_id,
			'b_second_id' => $this->b_second_id,
			'c_first_id' => $this->c_first_id,
			'c_second_id' => $this->c_second_id,
			'ignore_scores' => $this->ignore_scores ? 1 : 0,
			'back_nine' => $this->back_nine ? 1 : 0,
		]);

        $this->modal('week-edit')->close();

		Flux::toast('Week updated successfully.');
    }

    public function remove()
    {
        $this->modal('week-remove')->show();
    }

	public function with(): array
    {
        return [
            'years' => Year::orderby('name', 'desc')->get(),
        ];
    }
}; ?>

<flux:table.row>
    <flux:table.cell variant="strong">
		{{ $week->week_order }}
	</flux:table.cell>

    <flux:table.cell>
		{{ \Carbon\Carbon::parse($week->week_date)->format('F j, Y') }}
	</flux:table.cell>

	<flux:table.cell>
		{{ $week->year->name }}
	</flux:table.cell>

	<flux:table.cell>
		{{ $week->side_games }}
	</flux:table.cell>

	<flux:table.cell class="text-center">
		@if($week->back_nine)
			<flux:icon.check-badge class="text-red-500 dark:text-red-300" />
		@endif
	</flux:table.cell>

    <flux:table.cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-32">
                <flux:menu.item href="{{ route('week-score-edit', [$week]) }}" icon="cursor-arrow-ripple">Edit Week Scores</flux:menu.item>
                <flux:menu.item wire:click="edit" icon="pencil-square">Edit</flux:menu.item>
                <flux:menu.item wire:click="remove" icon="trash" variant="danger">Remove</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:modal name="week-remove" class="min-w-[22rem]">
            <form class="space-y-6" wire:submit="$parent.remove({{ $week->id }})">
                <div>
                    <flux:heading size="lg">Remove week?</flux:heading>

                    <flux:subheading>
                        <p>You're about to delete this week.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger">Remove week</flux:button>
                </div>
            </form>
        </flux:modal>

        <flux:modal name="week-edit" class="md:w-96" variant="flyout">
            <form wire:submit="update" class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit week</flux:heading>
                    <flux:subheading>Update a week on the site.</flux:subheading>
                </div>

				<flux:select wire:model="year_id" label="Year">
					<flux:select.option value="">Select a year</flux:select.option>
					@foreach($years as $year)
						<flux:select.option value="{{ $year->id }}">{{ $year->name }}</flux:select.option>
					@endforeach
				</flux:select>

				<flux:input wire:model="week_order" label="Week Order" />

				<flux:date-picker wire:model="week_date" label="Week Date" />

				<flux:select wire:model="side_games" label="Side Games">
					<flux:select.option>Pin</flux:select.option>
					<flux:select.option>Low Net</flux:select.option>
				</flux:select>

				<flux:checkbox wire:model="ignore_scores" label="Ignore Week" />

				<flux:checkbox wire:model="back_nine" label="Back Nine" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update week</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:table.cell>
</flux:table.row>
