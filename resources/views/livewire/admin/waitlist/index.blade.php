<?php

use App\Models\Waitlist;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new
#[Layout('components.layouts.admin')]
#[Title('Waitlist')]
class extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function remove($id)
    {
        Waitlist::findOrFail($id)->delete();

        $this->resetPage();

        Flux::modal('waitlist-remove')->close();

        Flux::toast('Entry has been deleted.');
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where('name', 'like', '%'.$this->search.'%');
    }

    public function with(): array
    {
        $entries = Waitlist::query();

        $entries = $this->applySearch($entries);

        $entries = $entries->orderByRaw('`order` IS NULL ASC, `order` ASC')->orderBy('created_at', 'asc')->paginate(20);

        return [
            'entries' => $entries,
        ];
    }
}; ?>

<div>
    <div class="flex justify-between items-center">
        <div>
            <flux:heading>Waitlist</flux:heading>
            <flux:subheading>Manage players waiting to join the league</flux:subheading>
        </div>
    </div>

    <div class="mt-8 w-full lg:w-1/3">
        <flux:input wire:model.live="search" placeholder="Search waitlist..." />
    </div>

    <flux:table :paginate="$entries" class="mt-8">
        <flux:table.columns>
            <flux:table.column class="w-16">#</flux:table.column>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Projected HC</flux:table.column>
            <flux:table.column>Linked User</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Joined</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($entries as $entry)
                <livewire:admin.waitlist.entry :$entry :key="$entry->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
