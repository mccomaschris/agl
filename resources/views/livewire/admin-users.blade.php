<div>
	<div class="px-4 sm:px-6 lg:px-8">
		<div class="flex items-center justify-between">
			<div class="sm:flex-auto">
				<h1 class="text-lg font-semibold leading-6 text-grey-900">Users</h1>
			</div>
			<div class="text-center">
				<x-button.primary wire:click="create">Add User</x-button.primary>
			</div>
		</div>
		<div class="py-12">
			<div>
				<x-input.text wire:model="filters.search" placeholder="Search Users..." />
			</div>
		</div>
		<div class="mt-8 flow-root">
			<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
					<table class="min-w-full divide-y divide-grey-300">
						<thead>
							<tr>
								<th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-grey-900 sm:pl-0">Name</th>
								<th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-grey-900">Email</th>
								<th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-grey-900">Phone #</th>
								<th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-grey-900">Status</th>
								<th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-grey-900">Admin</th>
								<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
									<span class="sr-only">Edit</span>
								</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-grey-200">
							@forelse ($users as $user)
							<tr>
								<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-grey-900 sm:pl-0">{{ $user->name }}</td>
								<td class="whitespace-nowrap py-4 px-3 text-sm text-grey-500">{{ $user->email }}</td>
								<td class="whitespace-nowrap py-4 px-3 text-sm text-grey-500">{{ $user->phone }}</td>
								<td class="whitespace-nowrap py-4 px-3 text-sm text-grey-500 text-center">
									@if($user->active)
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 stroke-green-500"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
									@else
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 stroke-red-500"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
									@endif
								</td>
								<td class="whitespace-nowrap py-4 px-3 text-sm text-grey-500">@if($user->admin)<span class="text-green-500 font-semibold">Admin</span>@endif</td>
								<td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
									<x-button.link wire:click="edit({{ $user->id }})">Edit<span class="sr-only">, {{ $user->name }}</span></x-button.link>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="6" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-grey-900 sm:pl-0">No users found...</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Save Transaction Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit User</x-slot>

            <x-slot name="content">
				<x-input.group for="name" label="Name" :error="$errors->first('user.name')">
                    <x-input.text wire:model="editing.name" id="name" placeholder="Name" required />
                </x-input.group>

				<x-input.group for="email" label="Email Address" :error="$errors->first('editing.email')">
                    <x-input.text type="email" wire:model="editing.email" id="email" placeholder="Email Address" required />
                </x-input.group>

				<x-input.group for="phone" label="Phone Number" :error="$errors->first('user.phone')">
                    <x-input.text wire:model="editing.phone" id="phone" placeholder="Phone Number" />
                </x-input.group>

                <x-input.group for="active" label="Active" :error="$errors->first('editing.active')">
                    <x-input.select wire:model="editing.active" id="active">
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                    </x-input.select>
                </x-input.group>

				<x-input.group for="admin" label="Admin" :error="$errors->first('editing.admin')">
                    <x-input.checkbox wire:model="editing.admin" id="admin" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
