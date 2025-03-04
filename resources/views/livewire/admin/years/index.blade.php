<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Year;

new
#[Layout('components.layouts.admin')]
#[Title('All Years')]
class extends Component {
    use WithPagination;

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
                Rule::unique('years'),
            ],
            'start_date' => 'nullable|date',
			'skip_date' => 'nullable|date',
			'active' => 'nullable|boolean',
        ];
    }

	public function remove($id)
    {
		Year::findOrFail($id)->delete();

		$this->resetPage();

        Flux::modal('year-remove')->close();

		Flux::toast('Year deleted successfully.');
    }

	public function save()
    {
        $this->validate();

		$year = Year::create([
			'name' => $this->name,
			'active' => $this->active ? 1 : 0,
			'start_date' => $this->start_date,
			'skip_date' => $this->skip_date,
		]);

		$others = Year::where('active', 1)->where('id', '!=', $year->id)->get();

		foreach($others as $other) {
			$other->update(['active' => 0]);
		}

		$this->reset(['name', 'active', 'start_date', 'skip_date']);

        $this->modal('year-add')->close();

		Flux::toast('Year created successfully.');
    }

    public function with(): array
    {
        return [
            'years' => Year::orderby('name', 'desc')->paginate(25),
        ];
    }
}; ?>

<div>
	<div class="flex justify-between items-center">
        <div>
            <flux:heading>Years</flux:heading>
            <flux:subheading>Manage the site's years and their status</flux:subheading>
        </div>

        <flux:modal.trigger name="year-add">
            <flux:button size="sm" icon="user-plus">Add year</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:table class="mt-8">
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Active</flux:table.column>
            <flux:table.column>Start Date</flux:table.column>
            <flux:table.column>Skip Date</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($years as $year)
                <livewire:admin.years.year :$year :key="$year->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
