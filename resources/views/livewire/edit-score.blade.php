<x-table.tr-body>
	<x-table.td id="{{ $score->id }}" class="text-sm! pl-2! text-left! whitespace-normal!">
		<a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player->user->name }}</a>
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

    <x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_1" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_2" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_3" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_4" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_5" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_6" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_7" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_8" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_9" class="w-20!" onfocus="this.select()" />
	</x-table.td>
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
