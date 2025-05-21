<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'AGL' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

	<link rel="stylesheet" href="{{ twcss('/css/main.css') }}">
	<link rel="stylesheet" href="{{ twcss('/css/admin.css') }}">
	@fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
	<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

		<flux:brand href="{{ route('admin.users.index') }}" name="AGL18" class="px-2 dark:hidden" />
		<flux:brand href="{{ route('admin.users.index') }}" name="AGL18" class="px-2 hidden dark:flex" />

		<flux:navlist variant="outline">
			<flux:navlist.item icon="home" href="{{ route('admin.index') }}">Dashboard</flux:navlist.item>
			<flux:navlist.item icon="users" href="{{ route('admin.users.index') }}">Users</flux:navlist.item>
			<flux:navlist.item icon="calendar" href="{{ route('admin.years.index') }}">Years</flux:navlist.item>
			<flux:navlist.item icon="calendar-days" href="{{ route('admin.weeks.index') }}">Weeks</flux:navlist.item>
			<flux:navlist.item icon="user-group" href="{{ route('admin.teams.index') }}">Teams</flux:navlist.item>
		</flux:navlist>


    </flux:sidebar>
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    </flux:header>
    <flux:main>
		{{ $slot }}
	</flux:main>

	@persist('toast')
        <flux:toast />
    @endpersist

	@fluxScripts
</body>
</html>
