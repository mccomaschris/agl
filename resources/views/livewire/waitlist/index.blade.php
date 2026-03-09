<?php

use App\Mail\AddedToWaitlist;
use App\Models\Waitlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

new
#[Layout('components.layouts.app')]
class extends Component
{
    public $name = '';

    public $projected_hc = '';

    protected $rules = [
        'name' => 'required|string',
        'projected_hc' => 'required|integer',
    ];

    public function save()
    {
        $this->validate();

        $waitlist = Waitlist::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'projected_hc' => $this->projected_hc,
        ]);

        Mail::to('mccomas.chris@gmail.com')->send(new AddedToWaitlist($waitlist));

        $this->reset(['name', 'projected_hc']);
    }

    public function with(): array
    {
        return [
            'members' => Waitlist::where('active', 1)
                ->orderByRaw('`order` IS NULL ASC, `order` ASC')
                ->orderBy('created_at', 'asc')
                ->get(),
        ];
    }
}; ?>

<div>
    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
        <flux:heading size="xl">AGL Waiting List</flux:heading>
    </div>


<div class="flex flex-col lg:flex-row gap-8">
    <div class="flex-1 min-w-0">
        <flux:heading size="lg" class="mb-4">Current Waiting List</flux:heading>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Projected HC</flux:table.column>
                <flux:table.column>Added By</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($members as $member)
                    <flux:table.row>
                        <flux:table.cell variant="strong">{{ $member->name }}</flux:table.cell>
                        <flux:table.cell>{{ $member->projected_hc }}</flux:table.cell>
                        <flux:table.cell>{{ $member->user->name }}</flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell>No one has been added to the wait list.</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <div class="w-full lg:w-96 lg:shrink-0">
        <flux:card>
            <flux:heading size="lg" class="mb-4">Add to Waiting List</flux:heading>
            <form wire:submit="save" class="space-y-4">
                <flux:input wire:model="name" label="Individual Name" placeholder="Name" />
                <flux:input wire:model="projected_hc" label="Projected HC" placeholder="Ex: 8" />
                <flux:button type="submit" variant="primary">Add to Wait List</flux:button>
            </form>
        </flux:card>
    </div>
</div>
</div>
