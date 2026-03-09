<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

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

    #[Validate('string|nullable')]
    public $search = '';

    public $filterActive = '';

    public $filterAdmin = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterActive()
    {
        $this->resetPage();
    }

    public function updatedFilterAdmin()
    {
        $this->resetPage();
    }

    public function remove($id)
    {
        User::findOrFail($id)->delete();

        $this->resetPage();

        Flux::modal('user-remove')->close();

        Flux::toast('User has been deleted.');
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

        $this->reset(['username', 'name', 'email', 'phone', 'admin', 'active']);

        $this->modal('user-add')->close();

        Flux::toast('User has been created.');
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where('name', 'like', '%'.$this->search.'%');
    }

    public function with(): array
    {
        $users = User::query();

        $users = $this->applySearch($users);

        if ($this->filterActive !== '') {
            $users->where('active', $this->filterActive);
        }

        if ($this->filterAdmin !== '') {
            $users->where('admin', $this->filterAdmin);
        }

        $users = $users->orderby('name', 'asc')->paginate(20);

        return [
            'users' => $users,
            'emails' => User::where('active', 1)
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->pluck('email')
                ->toArray(),
        ];
    }
}; ?>

<div>
    <div class="flex justify-between items-center">
        <div>
            <flux:heading>Site users</flux:heading>
            <flux:subheading>Manage the site's users and their roles</flux:subheading>
        </div>

		<div class="flex items-center space-x-4">
			<div
				x-data="{
				copyToClipboard(text) {
					navigator.clipboard.writeText(text).then(() => {
						Flux.toast({
							heading: 'Copied',
							text: 'The email addresses have been copied to the clipboard.',
							variant: 'success',
						})
					});
				}
				}"
			>
				<flux:button @click="copyToClipboard('{{ implode(', ', $emails) }}')" variant="ghost">Copy All Emails</flux:button>
			</div>

			<flux:modal.trigger name="user-add">
				<flux:button size="sm" icon="user-plus">Add user</flux:button>
			</flux:modal.trigger>
		</div>
    </div>

	<div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-4">
		<flux:input wire:model.live="search" placeholder="Search users..." class="" />
		<flux:select wire:model.live="filterActive">
			<flux:select.option value="">All statuses</flux:select.option>
			<flux:select.option value="1">Active</flux:select.option>
			<flux:select.option value="0">Inactive</flux:select.option>
		</flux:select>
		<flux:select wire:model.live="filterAdmin">
			<flux:select.option value="">All roles</flux:select.option>
			<flux:select.option value="1">Admin</flux:select.option>
			<flux:select.option value="0">Non-admin</flux:select.option>
		</flux:select>
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
