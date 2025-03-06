<x-layouts.app>
	<x-slot name="header">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight mt-6 mb-6 ">Members</h1>
	</x-slot>

	<div class="flex flex-wrap mt-6">
		@foreach($users as $user)
			<div class="w-full lg:w-1/4 mb-6 leading-normal">
				<p class="font-semibold">{{ $user->name }}</p>
				@if($user->phone == '304-123-4567')
					<p></p>
				@else
					<p><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></p>
				@endif
				<p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
			</div>
		@endforeach
	</div>
</x-layouts.app>
