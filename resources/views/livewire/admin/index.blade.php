<?php

use App\Models\Alert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Dashboard')]
class extends Component
{
    public ?int $editingId = null;

    public string $icon = 'information-circle';

    public string $title = '';

    public string $message = '';

    public bool $active = true;

    public function editAlert(Alert $alert): void
    {
        $this->editingId = $alert->id;
        $this->icon = $alert->icon;
        $this->title = $alert->title;
        $this->message = $alert->message;
        $this->active = $alert->active;
    }

    public function saveAlert(): void
    {
        $this->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($this->editingId) {
            Alert::find($this->editingId)->update([
                'icon' => $this->icon,
                'title' => $this->title,
                'message' => $this->message,
                'active' => $this->active,
            ]);
        } else {
            Alert::create([
                'icon' => $this->icon,
                'title' => $this->title,
                'message' => $this->message,
                'active' => $this->active,
            ]);
        }

        $this->reset(['editingId', 'icon', 'title', 'message', 'active']);
        $this->icon = 'information-circle';
        $this->active = true;
    }

    public function toggleAlert(Alert $alert): void
    {
        $alert->update(['active' => ! $alert->active]);
    }

    public function deleteAlert(Alert $alert): void
    {
        $alert->delete();
    }

    public function cancelEdit(): void
    {
        $this->reset(['editingId', 'title', 'message']);
        $this->icon = 'information-circle';
        $this->active = true;
    }

    public function with(): array
    {
        return [
            'alerts' => Alert::latest()->get(),
        ];
    }
}; ?>

<div class="space-y-8">

    {{-- Existing Alerts --}}
    @if ($alerts->isNotEmpty())
        <div>
            <flux:heading size="lg" class="mb-4">Homepage Alerts</flux:heading>
            <div class="space-y-3">
                @foreach ($alerts as $alert)
                    <div class="flex items-start gap-4 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                        <flux:icon :name="$alert->icon" class="size-5 mt-0.5 shrink-0 text-zinc-500" />
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-sm">{{ $alert->title }}</span>
                                <flux:badge :color="$alert->active ? 'green' : 'zinc'" size="sm">
                                    {{ $alert->active ? 'Active' : 'Inactive' }}
                                </flux:badge>
                            </div>
                            <p class="text-sm text-zinc-500">{{ $alert->message }}</p>
                            <p class="text-xs text-zinc-400 mt-1">Icon: <code>{{ $alert->icon }}</code></p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <flux:button size="sm" variant="ghost" wire:click="toggleAlert({{ $alert->id }})">
                                {{ $alert->active ? 'Deactivate' : 'Activate' }}
                            </flux:button>
                            <flux:button size="sm" variant="ghost" wire:click="editAlert({{ $alert->id }})">Edit</flux:button>
                            <flux:button size="sm" variant="danger" wire:click="deleteAlert({{ $alert->id }})" wire:confirm="Delete this alert?">Delete</flux:button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Create / Edit Form --}}
    <div>
        <flux:heading size="lg" class="mb-4">{{ $editingId ? 'Edit Alert' : 'New Alert' }}</flux:heading>
        <form wire:submit="saveAlert" class="space-y-4 max-w-lg">
            <flux:field>
                <flux:label>Icon</flux:label>
                <flux:input wire:model="icon" placeholder="e.g. snowflake, bell, information-circle" />
                <flux:description>Heroicon name — see <a href="https://heroicons.com" target="_blank" class="underline">heroicons.com</a></flux:description>
                <flux:error name="icon" />
            </flux:field>

            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input wire:model="title" placeholder="Alert title" />
                <flux:error name="title" />
            </flux:field>

            <flux:field>
                <flux:label>Message</flux:label>
                <flux:textarea wire:model="message" rows="3" placeholder="Alert message..." />
                <flux:error name="message" />
            </flux:field>

            <flux:field variant="inline">
                <flux:checkbox wire:model="active" />
                <flux:label>Active (show on homepage)</flux:label>
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary">{{ $editingId ? 'Update Alert' : 'Create Alert' }}</flux:button>
                @if ($editingId)
                    <flux:button type="button" wire:click="cancelEdit">Cancel</flux:button>
                @endif
            </div>
        </form>
    </div>

</div>
