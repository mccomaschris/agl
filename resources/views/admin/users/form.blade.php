{{ csrf_field() }}

<div class="p-8">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/2 px-4">
            <label class="admin-form-label">Username:</label>
            <input ref="input" class="admin-form-input {{ $errors->has('name') ? ' border-red-500 ' : '' }}" name="username" value="{{ old('username') ?? $user->username }}" required>
            @if ($errors->has('username'))
                <div class="admin-form-error">The username is required.</div>
            @endif
        </div>

        <div class="w-full lg:w-1/2 px-4">
            <label class="admin-form-label">Name:</label>
            <input ref="input" class="admin-form-input {{ $errors->has('name') ? ' border-red-500 ' : '' }}" name="name" value="{{ old('name') ?? $user->name }}" required>
            @if ($errors->has('name'))
                <div class="admin-form-error">The user's name is. required</div>
            @endif
        </div>

        <div class="w-full lg:w-1/2 px-4 mt-0 lg:mt-8">
            <label class="admin-form-label">Email:</label>
            <input ref="input" class="admin-form-input {{ $errors->has('email') ? ' border-red-500 ' : '' }}" type="email" name="email" value="{{ old('email') ?? $user->email }}">
            @if ($errors->has('email'))
                <div class="admin-form-error">You must enter a proper email address.</div>
            @endif
        </div>

        <div class="w-full lg:w-1/2 px-4 mt-0 lg:mt-8">
            <label class="admin-form-label">Phone:</label>
            <input ref="input" class="admin-form-input {{ $errors->has('phone') ? ' border-red-500 ' : '' }}" type="text" name="phone" value="{{ old('phone') ?? $user->phone }}">
            @if ($errors->has('phone'))
                <div class="admin-form-error">You must enter a proper phone number.</div>
            @endif
        </div>
    </div>

    <div class="flex flex-col mt-8">
        <div class="md:w-2/3 block">
            <input class="mr-2 leading-tight" type="checkbox" name="active" {{ (old('active') || $user->active) ? " checked " : "" }}>
            <span class="text-sm font-semibold">
                Active
            </span>
        </div>

        <div class="md:w-2/3 block mt-2">
            <input class="mr-2 leading-tight" type="checkbox" name="admin" {{ (old('admin') || $user->admin) ? " checked " : "" }}>
            <span class="text-sm font-semibold">
                Admin
            </span>
        </div>
    </div>
</div>

<div class="px-8 py-4 bg-grey-100 border-t border-grey-200 flex items-center">
    <button type="submit" class="btn btn-green">
        {{ $submitButtonText ?? 'Create User' }}
    </button>
    <a href="/admin/users" class="ml-8 text-red-500 font-semibold hover:underline hover:text-red-darker">Cancel</a>
</div>
