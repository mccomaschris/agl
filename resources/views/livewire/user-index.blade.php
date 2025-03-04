<?php

use Livewire\Volt\Component;
use function Livewire\Volt\{layout, state};

new class extends Component {
    state('users');
	layout('components.layouts.admin');
}; ?>

<div>
    From Users Index.
</div>
