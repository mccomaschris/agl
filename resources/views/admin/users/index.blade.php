@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
		<h1 class="font-bold text-3xl">Users</h1>
		<a href="/admin/users/create" class="px-6 py-3 rounded bg-green-500 text-white text-sm font-bold hover:text-white hover:bg-green-600">
			<span>Create</span>
			<span class="hidden md:inline">User</span>
		</a>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                    <th class="px-6 pt-6 pb-4">Email</th>
                    <th class="px-6 pt-6 pb-4">Password</th>
                    <th class="px-6 pt-6 pb-4" colspan="2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-zinc-100 focus-within:bg-zinc-lightest group text-zinc-500">
                        <td class="border-t px-6 py-4  group-hover:text-green-500 ">
                            <div class="flex justify-between items-center">
                                <a href="/admin/users/{{ $user->id }}/edit" class="{{ $user->active ? 'text-green-500' : 'text-zinc-300' }}">{{ $user->name }}</a>

                                @if($user->admin)
                                    <div class="pill pill-green">ADMIN</div>
                                @endif
                            </div>
                        </td>
                        <td class="border-t px-6 py-4 group-hover:text-green-500"><a href="mailto:{{ $user->email }}" class="{{ $user->active ? 'text-green-500' : 'text-zinc-300' }}">{{ $user->email }}</a></td>
                        <td class="border-t px-6 py-4 group-hover:text-green-500">
                            @if($user->email)
                                <update-button class="btn btn-green cursor-pointer" endpoint="/admin/passwords/{{ $user->id }}">Update Password</update-button>
                            @endif
                        </td>
                        <td class="border-t px-6 py-4 group-hover:text-green-500">
                            @if($user->active)
                                <span class="pill pill-green">Active</span>
                            @else
                                <span class="pill pill-grey">Inactive</span>
                            @endif
                        </td><td class="border-t w-px">
                            <a href="/admin/users/{{ $user->id }}/edit" class="text-zinc-500 group-hover:text-green-500 px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block w-6 h-6 fill-current" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
@endsection
