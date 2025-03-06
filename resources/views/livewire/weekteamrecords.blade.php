<?php

use Livewire\Volt\Component;
use App\Models\Year;

new class extends Component {
    public $selectedYear;
    public $years;

    public function mount()
    {
        $this->years = Year::orderBy('id', 'desc')->get();
        $this->selectedYear = $this->years->first()?->id;
    }

    public function calculateStats()
    {
        if ($this->selectedYear) {
            dispatch(new CalculateTeamStatsJob($this->selectedYear));
            session()->flash('message', 'Team stats calculation job dispatched!');
        }
    }
}; ?>

<div>
	<flux:modal.trigger name="update-records">
		<flux:navlist.item x-on:click="edit">Update Weekly Team Records</flux:navlist.item>
	</flux:modal.trigger>

	<flux:modal name="update-records" class="md:w-96" variant="flyout">
		<form wire:submit="update" class="space-y-6">
			<div>
				<flux:heading size="lg">Update Team Records</flux:heading>
				<flux:subheading>Use this tool to update week by week team records.</flux:subheading>
			</div>

			<flux:select wire:model="selectedYear" label="Year">
				<flux:select.option value="">Select a year</flux:select.option>
				@foreach($years as $year)
					<flux:select.option value="{{ $year->id }}">{{ $year->name }}</flux:select.option>
				@endforeach
			</flux:select>

			<div class="flex">
				<flux:spacer />

				<flux:button type="submit" variant="primary">Update records</flux:button>
			</div>
		</form>
	</flux:modal>
</div>
