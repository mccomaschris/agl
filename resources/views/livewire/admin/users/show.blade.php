<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\User;

new
#[Layout('layouts.backend')]
#[Title('Show User')]
class extends Component {
    public User $user;


}; ?>

<div>
	<div class="flex justify-between items-center">
        <div>
            <flux:heading>Show User {{ $user->name }}</flux:heading>
            <flux:subheading>View the user player profiles</flux:subheading>
        </div>
    </div>
</div>
