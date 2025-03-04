<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
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

	public function updatedSearch()
    {
		$this->resetPage();
    }

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

	#[Layout('components.layouts.admin')]
	#[Title('All Users')]
    public function render()
    {
		$users = User::when($this->search !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
			->orderby('name', 'asc')
			->paginate(25);

        return view('livewire.admin.user-index', [
			'users' => $users,
		]);
    }
}
