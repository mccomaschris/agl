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

    public function edit()
    {
        $this->modal('year-edit')->show();
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

		$others = Year::where('active', 1)->where('id', '!=', $this->year->id)->get();

		if ($this->active) {
			$others->each->update(['active' => 0]);
		}

        $this->modal('year-edit')->close();

		Flux::toast('Year updated successfully.');
    }

    public function remove()
    {
        $this->modal('year-remove')->show();
    }
}; ?>

<flux:row>
    <flux:cell variant="strong">
		{{ $year->name }}
	</flux:cell>

    <flux:cell>
		@if($year->active)
			<flux:badge color="emerald" size="sm" inset="top bottom">Active</flux:badge>
		@else
			<flux:badge size="sm" inset="top bottom">Inactive</flux:badge>
		@endif
	</flux:cell>

	<flux:cell>
		{{ $year->start_date }}
	</flux:cell>

	<flux:cell>
		{{ $year->skip_date }}
	</flux:cell>

    <flux:cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-32">
                <flux:menu.item wire:click="edit" icon="pencil-square">Edit</flux:menu.item>
                <flux:menu.item wire:click="remove" icon="trash" variant="danger">Remove</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:modal name="year-remove" class="min-w-[22rem]">
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

        <flux:modal name="year-edit" class="md:w-96" variant="flyout">
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
    </flux:cell>
</flux:row>
