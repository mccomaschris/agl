<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Week;
use App\Models\Year;

new
#[Layout('components.layouts.admin')]
#[Title('All Weeks')]
class extends Component {
    use WithPagination;

	public $year_id = '';
	public $week_order = '';
	public $week_date = '';
	public $side_games = '';
	public $a_first_id = '';
	public $a_second_id = '';
	public $b_first_id = '';
	public $b_second_id = '';
	public $c_first_id = '';
	public $c_second_id = '';
	public $ignore_scores = false;
	public $back_nine = false;

	public function rules()
    {
        return [
            'year_id' => ['required'],
            'week_order' => ['required'],
			'week_date' => ['required', 'date'],
			'side_games' => ['required'],
			'a_first_id' => ['required'],
			'a_second_id' => ['required'],
			'b_first_id' => ['required'],
			'b_second_id' => ['required'],
			'c_first_id' => ['required'],
			'c_second_id' => ['required'],
			'ignore_scores' => ['nullable', 'boolean'],
			'back_nine' => ['nullable', 'boolean'],
		];
    }

	public function remove($id)
    {
		Year::findOrFail($id)->delete();

		$this->resetPage();

        Flux::modal('week-remove')->close();

		Flux::toast('Week deleted successfully.');
    }

	public function save()
    {
        $this->validate();

		$week = Week::create([
			'year_id' => $this->year_id,
			'week_order' => $this->week_order,
			'week_date' => $this->week_date,
			'side_games' => $this->side_games,
			'a_first_id' => $this->a_first_id,
			'a_second_id' => $this->a_second_id,
			'b_first_id' => $this->b_first_id,
			'b_second_id' => $this->b_second_id,
			'c_first_id' => $this->c_first_id,
			'c_second_id' => $this->c_second_id,
			'ignore_scores' => $this->ignore_scores ? 1 : 0,
			'back_nine' => $this->back_nine ? 1 : 0,
		]);

		$this->reset([
			'year_id',
			'week_order',
			'week_date',
			'side_games',
			'a_first_id',
			'a_second_id',
			'b_first_id',
			'b_second_id',
			'c_first_id',
			'c_second_id',
			'ignore_scores',
			'back_nine',
		]);

        $this->modal('week-add')->close();

		Flux::toast('Week created successfully.');
    }

    public function with(): array
    {
        return [
            'weeks' => Week::orderby('week_date', 'desc')->paginate(25),
        ];
    }
}; ?>

<div>
	<div class="flex justify-between items-center">
        <div>
            <flux:heading>Weeks</flux:heading>
            <flux:subheading>Manage the site's weeks and their status</flux:subheading>
        </div>

        <flux:modal.trigger name="week-add">
            <flux:button size="sm" icon="user-plus">Add week</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:table :paginate="$weeks" class="mt-8">
        <flux:table.columns>
            <flux:table.column>Week Order</flux:table.column>
            <flux:table.column>Week Date</flux:table.column>
            <flux:table.column>Year</flux:table.column>
            <flux:table.column>Side Game</flux:table.column>
            <flux:table.column>Back Nine</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($weeks as $week)
                <livewire:admin.weeks.week :$week :key="$week->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
