<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Year;
use Carbon\Carbon;
use McComasChris\MarcoAnalytics\Models\MarcoAnalytics;

new
class extends Component {
	public $timeframe = 30; // Default timeframe in days

    #[On('update-timeframe')] // Live update when timeframe changes
    public function updateTimeframe($days)
    {
        $this->timeframe = $days;
    }

    public function with(): array
    {
		$startDate = Carbon::now()->subDays($this->timeframe);

        return [
            'visitCounts' => MarcoAnalytics::where('created_at', '>=', $startDate)
				->selectRaw("device, COUNT(*) as total")
				->groupBy('device')
				->pluck('total', 'device'),
        ];
    }
}; ?>
<div>
	<div class="flex justify-between items-center mb-6">
		<div class="flex items-center gap-2">
			<div class="flex items-center gap-2">
				<flux:select wire:model="timeframe" size="sm" class="">
					<option value="7">Last 7 days</option>
					<option value="14">Last 14 days</option>
					<option value="30">Last 30 days</option>
					<option value="60">Last 60 days</option>
					<option value="90">Last 90 days</option>
				</flux:select>
			</div>
		</div>
	</div>

	<div class="flex gap-6 mb-6">
		<div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
			<flux:subheading>Desktop</flux:subheading>
			<flux:heading size="xl" class="mb-2">{{ $visitCounts['Desktop'] ?? 0 }}</flux:heading>
		</div>

		<div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
			<flux:subheading>Tablet</flux:subheading>
			<flux:heading size="xl" class="mb-2">{{ $visitCounts['Tablet'] ?? 0 }}</flux:heading>
		</div>

		<div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
			<flux:subheading>Mobile</flux:subheading>
			<flux:heading size="xl" class="mb-2">{{ $visitCounts['Mobile'] ?? 0 }}</flux:heading>
		</div>
	</div>
</div>
