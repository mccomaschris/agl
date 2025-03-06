<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Year;

new
#[Layout('components.layouts.admin')]
#[Title('Dashboard')]
class extends Component {

    public function with(): array
    {
        return [
            'years' => Year::orderby('name', 'desc')->paginate(25),
        ];
    }
}; ?>

<div>
	<livewire:admin.device-stats />
</div>
