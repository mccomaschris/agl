<?php

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Year;

new class extends Component {
	public Year $year;

	public $name = '';
	public $start_date = '';
	public $skip_date = '';
	public $active = '';

	public function rules()
    {
        return [
            'name' => [
                'required',
				'string',
                Rule::unique('years')->ignore($this->year->id),
            ],
            'start_date' => 'nullable|date',
			'skip_date' => 'nullable|date',
			'active' => 'nullable|boolean',
        ];
    }

    public function mount()
    {
        $this->name = $this->year->name;
        $this->active = $this->year->active;
        $this->start_date = $this->year->start_date;
        $this->skip_date = $this->year->skip_date;
    }

    public function update()
    {
        $this->validate();

        $this->year->update([
			'name' => $this->name,
			'active' => $this->active ? 1 : 0,
			'start_date' => $this->start_date,
			'skip_date' => $this->skip_date,
        ]);

        $this->modal('year-edit' . $this->year->id)->close();

		Flux::toast('Year updated successfully.');
    }
}; ?>

<flux:table.row>
    <flux:table.cell variant="strong">
		{{ $year->name }}
	</flux:table.cell>

    <flux:table.cell>
		@if($year->active)
			<flux:badge color="emerald" size="sm" inset="top bottom">Active</flux:badge>
		@else
			<flux:badge size="sm" inset="top bottom">Inactive</flux:badge>
		@endif
	</flux:table.cell>

	<flux:table.cell>
		{{ $year->start_date }}
	</flux:table.cell>

	<flux:table.cell>
		{{ $year->skip_date }}
	</flux:table.cell>

    <flux:table.cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-32">
				<flux:modal.trigger :name="'year-edit-'.$year->id">
					<flux:menu.item icon="pencil-square">Edit</flux:menu.item>
				</flux:modal.trigger>
				<flux:modal.trigger :name="'year-remove-'.$year->id">
					<flux:menu.item icon="trash" variant="danger">Remove</flux:menu.item>
				</flux:modal.trigger>
            </flux:menu>
        </flux:dropdown>

        <flux:modal :name="'year-remove-'.$year->id" class="min-w-[22rem]">
            <form class="space-y-6" wire:submit="$parent.remove({{ $year->id }})">
                <div>
                    <flux:heading size="lg">Remove year?</flux:heading>

                    <flux:subheading>
                        <p>You're about to delete this year.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger">Remove year</flux:button>
                </div>
            </form>
        </flux:modal>

        <flux:modal :name="'year-edit-'.$year->id" class="md:w-96" variant="flyout">
            <form wire:submit="update" class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit year</flux:heading>
                    <flux:subheading>Update a year on the site.</flux:subheading>
                </div>

                <flux:input wire:model="name" label="Name" />

				<flux:checkbox wire:model="active" label="Active Year" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update year</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:table.cell>
</flux:table.row>
