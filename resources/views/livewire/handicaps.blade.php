<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">{{ $year->name }} Handicaps</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More Years Handicaps</flux:button>

			<flux:navmenu>
				@foreach ($years as $item)
					<flux:navmenu.item href="{{ route('handicaps', [$item]) }}" wire:navigate class="{{ $item->id === $year->id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $item->name }} Handicaps</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">One Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$ones" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">Two Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$twos" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">Three Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$threes" />
		</div>
	</div>

	<div class="mb-12">
		<flux:heading size="lg" class="mb-1">Four Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$fours" />
		</div>
	</div>
</div>
