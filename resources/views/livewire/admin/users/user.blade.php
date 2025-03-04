<?php

use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\User;

new class extends \Livewire\Volt\Component {
    public User $user;

	public $username;

    #[Validate('string|required')]
    public $name = '';

    #[Validate('string|nullable|email')]
    public $email = '';

	#[Validate('string|nullable')]
	public $phone = '';

    #[Validate('boolean|nullable')]
    public $admin = false;

	#[Validate('boolean|nullable')]
    public $active = false;

    public function mount()
    {
        $this->username = $this->user->username;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->admin = $this->user->admin;
        $this->active = $this->user->active;
    }

    public function edit()
    {
        $this->modal('user-edit')->show();
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'admin' => $this->admin ? 1 : 0,
			'active' => $this->active ? 1 : 0,
        ]);

        $this->modal('user-edit')->close();
    }

    public function remove()
    {
        $this->modal('user-remove')->show();
    }
}
?>

<flux:table.row data-user-id="{{ $user->id }}">
    <flux:table.cell variant="strong">
		{{ $user->name }}
	</flux:table.cell>

    <flux:table.cell>{{ $user->email }}</flux:table.cell>

	<flux:table.cell>{{ $user->phone }}</flux:table.cell>

    <flux:table.cell>
		@if($user->active)
			<flux:badge color="emerald" size="sm" inset="top bottom">Active</flux:badge>
		@else
			<flux:badge size="sm" inset="top bottom">Inactive</flux:badge>
		@endif
	</flux:table.cell>

	<flux:table.cell>
		@if($user->admin)
			<flux:badge color="emerald" size="sm" inset="top bottom">Admin</flux:badge>
		@endif
	</flux:table.cell>

    <flux:table.cell>
        <flux:dropdown align="end" offset="-15">
            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" inset="top bottom" />

            <flux:menu class="min-w-32">
                <flux:menu.item wire:click="edit" icon="pencil-square">Edit</flux:menu.item>
                <flux:menu.item wire:click="remove" icon="trash" variant="danger">Remove</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:modal name="user-remove" class="min-w-[22rem]">
            <form class="space-y-6" wire:submit="$parent.remove({{ $user->id }})">
                <div>
                    <flux:heading size="lg">Remove user?</flux:heading>

                    <flux:subheading>
                        <p>You're about to delete this user.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger">Remove user</flux:button>
                </div>
            </form>
        </flux:modal>

        <flux:modal name="user-edit" class="md:w-96" variant="flyout">
            <form wire:submit="update" class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit member</flux:heading>
                    <flux:subheading>Update a user on the site.</flux:subheading>
                </div>

                <flux:input disabled wire:model="username" label="Username" />

                <flux:input wire:model="name" label="Name" />

                <flux:input type="email" wire:model="email" label="Email" />

                <flux:input type="phone" wire:model="phone" label="Phone" />

                <flux:checkbox wire:model="admin" label="Site Admin" />

				<flux:checkbox wire:model="active" label="Active User" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update user</flux:button>
                </div>
            </form>
        </flux:modal>
    </flux:table.cell>
</flux:table.row>
