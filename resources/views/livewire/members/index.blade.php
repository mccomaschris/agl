<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new
#[Layout('components.layouts.app')]
class extends Component
{
    public function with(): array
    {
        return [
            'users' => User::where('active', 1)->orderBy('name')->get(),
        ];
    }
}; ?>

<div>
    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
        <flux:heading size="xl">Members</flux:heading>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($users as $user)
            <flux:card class="space-y-1">
                <flux:heading size="sm">{{ $user->name }}</flux:heading>
                @if ($user->phone !== '304-123-4567')
                    <flux:text><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></flux:text>
                @endif
                <flux:text><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></flux:text>
            </flux:card>
        @endforeach
    </div>
</div>
