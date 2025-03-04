<?php

use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\Player;
use App\Models\User;
use App\Models\Team;

new class extends Component {
    public int $playerId;
    public Player $player;

    #[Validate('integer|required')]
    public $user_id = '';

    #[Validate('boolean|nullable')]
    public $on_leave = '';

	#[Validate('boolean|nullable')]
	public $champion = '';

    #[Validate('integer|required')]
    public $team_id = null;

    #[Validate('integer|required')]
    public $year_id = null;

    #[Validate('integer|required')]
    public $position = '';

	#[Validate('string|nullabe')]
    public $tee_selection = null;

	#[Validate('integer|nullabe')]
	public $substitute = null;

    public function mount()
    {
        $this->user_id = $this->player->user_id;
        $this->on_leave = $this->player->on_leave;
        $this->team_id = $this->player->team_id;
        $this->year_id = $this->player->year_id;
        $this->position = $this->player->position;
		$this->tee_selection = $this->player->tee_selection;
		$this->champion = $this->player->champion;
		$this->substitute = $this->player->substitute;
    }

    public function edit()
    {
        $this->modal('player-edit')->show();
    }

    public function update()
    {
        $this->validate();

        $this->player->update([
            'user_id' => $this->user_id,
            'team_id' => $this->team_id,
            'year_id' => $this->year_id,
            'position' => $this->position,
            'tee_selection' => $this->tee_selection,
            'on_leave' => $this->on_leave ? 1 : 0,
            'champion' => $this->champion ? 1 : 0,
			'substitute' => $this->substitute,
        ]);

        $this->modal('player-edit')->close();
    }

    public function remove()
    {
        $this->modal('player-remove')->show();
    }

    public function with(): array
    {
        return [
            'teams' => Team::where('year_id', $this->year_id)->orderBy('name', 'asc')->get(),
            'users' => User::orderBy('name', 'asc')->get(),
        ];
    }
}
?>

<flux:table.row data-player-id="{{ $player->id }}">
    <flux:table.cell variant="strong">
		{{ $player->year->name }}
	</flux:table.cell>

    <flux:table.cell>{{ $player->won }}</flux:table.cell>

	<flux:table.cell>{{ $player->lost }}</flux:table.cell>

	<flux:table.cell>{{ $player->tied }}</flux:table.cell>

    <flux:table.cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-32">
                <flux:menu.item wire:click="edit" icon="pencil-square">Edit</flux:menu.item>
                <flux:menu.item wire:click="remove" icon="trash" variant="danger">Remove</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:modal name="player-remove" class="min-w-[22rem]">
            <form class="space-y-6" wire:submit="$parent.remove({{ $player->id }})">
                <div>
                    <flux:heading size="lg">Remove player?</flux:heading>

                    <flux:subheading>
                        <p>You're about to delete this player.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger">Remove player</flux:button>
                </div>
            </form>
        </flux:modal>

        <flux:modal name="player-edit" class="md:w-96" variant="flyout">
            <form wire:submit="update" class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit player</flux:heading>
                    <flux:subheading>Update a player profile on the site.</flux:subheading>
                </div>

				<flux:heading>{{ $player->year->name }} Season</flux:heading>

				<flux:select wire:model="team_id" label="Team">
					<flux:select.option value="">Select a team</flux:select.option>
					@foreach ($teams as $team)
						<flux:select.option value="{{ $team->id }}">{{ $team->name }}</flux:select.option>
					@endforeach
				</flux:select>

				<flux:select wire:model="tee_selection" label="Tee Selection">
					<flux:select.option value="">White Tees</flux:select.option>
					<flux:select.option value="yellow">Yellow Tees</flux:select.option>
				</flux:select>

				<flux:select wire:model="position" label="Position">
					<flux:select.option value="1">1</flux:select.option>
					<flux:select.option value="2">2</flux:select.option>
					<flux:select.option value="3">3</flux:select.option>
					<flux:select.option value="4">4</flux:select.option>
				</flux:select>

				<flux:select wire:model="substitute" label="Substitute">
					<flux:select.option value="">Select a sub</flux:select.option>
					@foreach ($users as $user)
						<flux:select.option value="{{ $user->id }}">{{ $user->name }}</flux:select.option>
					@endforeach
				</flux:select>

                <flux:checkbox wire:model="on_leave" label="On Leave" />

                <flux:checkbox wire:model="champion" label="Individual Champion" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update player</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:table.cell>
</flux:table.row>
