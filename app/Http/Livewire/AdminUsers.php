<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AdminUsers extends Component
{
	public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;

    public $filters = [
        'search' => '',
        'active' => '',
		'admin'  => '',
    ];

	public User $editing;

	public function rules() {
		return [
			'editing.name' => 'required',
			'editing.email' => 'required|unique:users,email,'.$this->editing->id,
			'editing.phone' => '',
			'editing.active' => '',
			'editing.admin' => '',
		];
	}

	public function mount() { $this->editing = $this->makeBlankUser(); }

	public function resetFilters() { $this->reset('filters'); }

	public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->showEditModal = true;
    }

	public function makeBlankUser()
    {
        return User::make(['date' => now()]);
    }

	public function edit(User $user)
    {
		if ($this->editing->isNot($user)) {
			$this->editing = $user;
		}

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()
            ->when($this->filters['active'], fn($query, $active) => $query->where('active', $active))
            ->when($this->filters['search'], fn($query, $search) => $query->where('name', 'like', '%'.$search.'%'));

        return $query->orderby('name', 'asc')->get();
    }

	public function getRowsProperty()
    {
        return $this->rowsQuery;
    }

    public function render()
    {
		$users = User::orderby('name', 'asc')->get();
        return view('livewire.admin-users', [
			'users' => $this->rows,
	])->layout('layouts.admin-two');
    }
}
