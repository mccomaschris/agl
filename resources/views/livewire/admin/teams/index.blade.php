<?php

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('All Teams')]
class extends Component
{
    use WithPagination;

    public function with(): array
    {
        return [
            'teams' => Team::orderby('id', 'desc')->paginate(25),
        ];
    }
}; ?>

<div>
	<div class="flex justify-between items-center">
        <div>
            <flux:heading>Teams</flux:heading>
            <flux:subheading>Manage the site's teams and their status</flux:subheading>
        </div>
    </div>

    <flux:table class="mt-8">
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Additional Points</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($teams as $team)
                <livewire:admin.teams.team :$team :key="$team->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
