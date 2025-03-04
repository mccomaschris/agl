<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\User;

new
#[Layout('components.layouts.admin')]
#[Title('All Users')]
class extends Component
{
    use WithPagination;

	#[Validate('string|required|unique:users,username')]
    public $username = '';

    #[Validate('string|required')]
    public $name = '';

    #[Validate('string|email|nullable')]
    public $email = '';

	#[Validate('string|nullable')]
	public $phone = '';

    #[Validate('boolean|nullable')]
    public $admin = '';

	#[Validate('boolean|nullable')]
    public $active = '';

	public function remove($id)
    {
		User::findOrFail($id)->delete();

		$this->resetPage();

        Flux::modal('user-remove')->close();
    }

	public function save()
    {
        $this->validate();

		User::create([
			'username' => $this->username,
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'admin' => $this->admin ? 1 : 0,
			'active' => $this->active ? 1 : 0,
			'password' => bcrypt('password'),
		]);

		$this->reset([ 'username', 'name', 'email', 'phone', 'admin', 'active' ]);

        $this->modal('user-add')->close();
    }

    public function with(): array
    {
        return [
            'users' => User::orderby('name', 'asc')->paginate(25),
        ];
    }
}; ?>

<div>
    <div class="flex justify-between items-center">
        <div>
            <flux:heading>Site users</flux:heading>
            <flux:subheading>Manage the site's users and their roles</flux:subheading>
        </div>

        <flux:modal.trigger name="user-add">
            <flux:button size="sm" icon="user-plus">Add user</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:table :paginate="$users" class="mt-8">
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Email</flux:table.column>
            <flux:table.column>Phone</flux:table.column>
            <flux:table.column>Active</flux:table.column>
            <flux:table.column>Admin</flux:table.column>
            <flux:table.column></flux:table.column>
		</flux:table.columns>

        <flux:table.rows>
            @foreach ($users as $user)
                <livewire:admin.users.user :$user :key="$user->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>

    <flux:modal name="user-add" class="md:w-96" variant="flyout">
        <form wire:submit="save" class="space-y-6">
            <div>
                <flux:heading size="lg">Add user</flux:heading>
                <flux:subheading>Create a new user for the site</flux:subheading>
            </div>

			<flux:input wire:model="username" label="Username" />

			<flux:input wire:model="name" label="Name" />

			<flux:input type="email" wire:model="email" label="Email" />

			<flux:input type="phone" wire:model="phone" label="Phone" />

			<flux:checkbox wire:model="admin" label="Site Admin" />

			<flux:checkbox wire:model="active" label="Active User" />

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
