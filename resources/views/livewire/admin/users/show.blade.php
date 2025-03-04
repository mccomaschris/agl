<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Player;

new
#[Layout('components.layouts.admin')]
#[Title('Show User')]
class extends Component {
    public User $user;

	public function with(): array
    {
        return [
            'players' => Player::where('user_id', $this->user->id)->orderby('year_id', 'desc')->get(),
        ];
    }
}; ?>

<div>

	<div class="flex justify-between items-center">
        <div>
            <flux:heading>Show User {{ $user->name }}</flux:heading>
            <flux:subheading>View the user player profiles</flux:subheading>
        </div>
    </div>

	<flux:breadcrumbs class="mt-8">
		<flux:breadcrumbs.item href="#">Home</flux:breadcrumbs.item>
		<flux:breadcrumbs.item href="{{ route('admin.users.index') }}">Users</flux:breadcrumbs.item>
		<flux:breadcrumbs.item>{{ $user->name }}</flux:breadcrumbs.item>
	</flux:breadcrumbs>

	<flux:table class="mt-8">
        <flux:table.columns>
            <flux:table.column>Season</flux:table.column>
            <flux:table.column>Won</flux:table.column>
            <flux:table.column>Lost</flux:table.column>
            <flux:table.column>Tied</flux:table.column>
            <flux:table.column></flux:table.column>
		</flux:table.columns>

        <flux:table.rows>
            @foreach ($players as $player)
				<livewire:admin.players.player :$player :key="$player->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
