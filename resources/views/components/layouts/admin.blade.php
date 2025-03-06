<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'AGL' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

	<link rel="stylesheet" href="{{ twcss('/css/admin.css') }}">

	@fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
	<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
		<flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

		<flux:brand href="{{ route('admin.users.index') }}" name="AGL18" class="px-2 dark:hidden" />
		<flux:brand href="{{ route('admin.users.index') }}" name="AGL18" class="px-2 hidden dark:flex" />

		<flux:navlist variant="outline">
			<flux:navlist.item icon="users" href="{{ route('admin.users.index') }}">Users</flux:navlist.item>
			<flux:navlist.item icon="calendar" href="{{ route('admin.years.index') }}">Years</flux:navlist.item>
			<flux:navlist.item icon="calendar-days" href="{{ route('admin.weeks.index') }}">Weeks</flux:navlist.item>
		</flux:navlist>

		<flux:spacer />

		<flux:navlist.group heading="Tools">
			<div
				x-data="{
					clearCache() {
							fetch('{{ route('admin.clear-cache') }}', {
									method: 'POST',
									headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
							})
							.then(response => response.json())
							.then(data => {
									if (data.success) {
										Flux.toast({
											heading: 'Cache Cleared',
											text: data.message,
											variant: 'success',
										});
									}
							})
							.catch(error => console.error('Cache clear error:', error));
					}
				}"
			>
				<flux:navlist.item @click="clearCache()" class="cursor-pointer">Clear Cache</flux:navlist.item>
			</div>
			<livewire:shiftweeks />
			<livewire:weekteamrecords />
		</flux:navlist.group>
	</flux:sidebar>

	<flux:header class="lg:hidden">
		<flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
	</flux:header>

	<flux:main>
		{{ $slot }}
	</flux:main>

	@fluxScripts
</body>
</html>
