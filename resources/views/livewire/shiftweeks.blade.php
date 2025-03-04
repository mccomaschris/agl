<?php

use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Models\Week;

new class extends Component {
	public $startDate;
	public $weeksToAdd;

	public function mount()
	{
		$this->startDate = Carbon::now();
		$this->weeksToAdd = 1;
	}

	public function update()
    {
        $weeks = Week::where('week_date', '>=', $this->startDate)->get();

		foreach ($weeks as $week) {
			$week->update([
				'week_date' => Carbon::parse($week->week_date)->addWeeks((int) $this->weeksToAdd),
			]);
		}

		$this->modal('shift-weeks')->close();

		Flux::toast('Weeks have been shifted.');
    }
}; ?>

<div>
	<flux:modal.trigger name="shift-weeks">
		<flux:navlist.item x-on:click="edit">Shift Weeks</flux:navlist.item>
	</flux:modal.trigger>

	<flux:modal name="shift-weeks" class="md:w-96" variant="flyout">
		<form wire:submit="update" class="space-y-6">
			<div>
				<flux:heading size="lg">Push weeks back</flux:heading>
				<flux:subheading>Use this tool to readjust the schedule if there is a rainout.</flux:subheading>
			</div>

			<flux:date-picker wire:model="startDate" label="Start Date" />

			<flux:input wire:model="weeksToAdd" label="Weeks to Push Back" type="number" />

			<div class="flex">
				<flux:spacer />

				<flux:button type="submit" variant="primary">Update weeks</flux:button>
			</div>
		</form>
	</flux:modal>
</div>
