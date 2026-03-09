<?php

use App\Models\Waitlist;
use Livewire\Component;

new class extends Component
{
    public Waitlist $entry;

    public $order = '';

    public function mount()
    {
        $this->order = $this->entry->order;
    }

    public function updateOrder()
    {
        $this->entry->update(['order' => $this->order === '' ? null : (int) $this->order]);

        Flux::toast('Order updated.');
    }

    public function toggleActive()
    {
        $this->entry->update(['active' => ! $this->entry->active]);

        Flux::toast($this->entry->active ? 'Entry marked active.' : 'Entry marked inactive.');
    }

    public function remove()
    {
        $this->modal('waitlist-remove-'.$this->entry->id)->show();
    }
}
?>

<flux:table.row>
    <flux:table.cell>
        <flux:input
            wire:model="order"
            wire:blur="updateOrder"
            wire:keydown.enter="updateOrder"
            type="number"
            min="1"
            size="sm"
            class="w-16 text-center"
        />
    </flux:table.cell>
    <flux:table.cell variant="strong">{{ $entry->name }}</flux:table.cell>

    <flux:table.cell>{{ $entry->projected_hc }}</flux:table.cell>

    <flux:table.cell>
        @if ($entry->user)
            <flux:link href="{{ route('admin.users.show', $entry->user) }}">
                {{ $entry->user->name }}
            </flux:link>
        @else
            <span class="text-zinc-400">—</span>
        @endif
    </flux:table.cell>

    <flux:table.cell>
        @if ($entry->active)
            <flux:badge color="emerald" size="sm" inset="top bottom">Active</flux:badge>
        @else
            <flux:badge size="sm" inset="top bottom">Inactive</flux:badge>
        @endif
    </flux:table.cell>

    <flux:table.cell>{{ $entry->created_at->format('M j, Y') }}</flux:table.cell>

    <flux:table.cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-36">
                <flux:menu.item wire:click="toggleActive" icon="arrow-path">
                    Mark {{ $entry->active ? 'Inactive' : 'Active' }}
                </flux:menu.item>
                <flux:modal.trigger :name="'waitlist-remove-'.$entry->id">
                    <flux:menu.item icon="trash" variant="danger">Remove</flux:menu.item>
                </flux:modal.trigger>
            </flux:menu>
        </flux:dropdown>

        <flux:modal :name="'waitlist-remove-'.$entry->id" class="min-w-[22rem]">
            <form class="space-y-6" wire:submit="$parent.remove({{ $entry->id }})">
                <div>
                    <flux:heading size="lg">Remove entry?</flux:heading>
                    <flux:subheading>
                        <p>You're about to delete {{ $entry->name }} from the waitlist.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex space-x-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="danger">Remove</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:table.cell>
</flux:table.row>
