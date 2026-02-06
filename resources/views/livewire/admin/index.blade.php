<?php

use App\Models\Year;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('components.layouts.admin')]
#[Title('Dashboard')]
class extends Component
{
    public function with(): array
    {
        return [
            'years' => Year::orderby('name', 'desc')->paginate(25),
        ];
    }
}; ?>

<div>

</div>
