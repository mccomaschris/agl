<?php

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Team;

new class extends Component {
	public Team $team;

	public $additional_points;

	public function rules()
    {
        return [
			'additional_points' => 'nullable|integer',
        ];
    }

    public function mount(Team $team)
	{
		$this->team = $team;
		$this->additional_points = $team->additional_points;
	}

    public function update()
    {
        $this->validate();

        $this->team->update([
			'additional_points' => $this->additional_points,
        ]);

        $this->modal('team-edit-' . $this->team->id)->close();

		Flux::toast('Team updated successfully.');
    }
}; ?>

<flux:table.row>
    <flux:table.cell variant="strong">
		{{ $team->year->name }} Team {{ $team->name }} ({{ $team->onePlayer->user->name }})
	</flux:table.cell>

	<flux:table.cell variant="strong">
		{{ $team->additional_points }}
	</flux:table.cell>

    <flux:table.cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-32">
				<flux:modal.trigger :name="'team-edit-'.$team->id">
					<flux:menu.item icon="pencil-square">Edit</flux:menu.item>
				</flux:modal.trigger>
            </flux:menu>
        </flux:dropdown>

        <flux:modal :name="'team-edit-'.$team->id" class="md:w-96" variant="flyout">
            <form wire:submit="update" class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit team</flux:heading>
                    <flux:subheading>Update a team on the site.</flux:subheading>
                </div>

                <flux:input wire:model="additional_points" label="Additional Points" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update team</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:table.cell>
</flux:table.row>
