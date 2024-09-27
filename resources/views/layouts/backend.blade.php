<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'AGL Dashboard' }} - AGLWV Dashboard</title>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..600&display=swap" rel="stylesheet">

		@vite('resources/css/app.css')

		@fluxStyles
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
		<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
			<flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

			<flux:brand href="#" logo="/agl.svg" name="AGL Dashboard" class="px-2 dark:hidden" />
			<flux:brand href="#" logo="/agl-dark-mode.svg" name="AGL Dashboard" class="px-2 hidden dark:flex" />

			{{-- <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" /> --}}

			<flux:navlist variant="outline">
				<flux:navlist.item icon="home" href="/admin/">Home</flux:navlist.item>
				<flux:navlist.item icon="users" href="{{ route('admin.users.index') }}">Users</flux:navlist.item>
				<flux:navlist.item icon="calendar" href="{{ route('admin.years.index') }}">Years</flux:navlist.item>
			</flux:navlist>

			<flux:spacer />
		</flux:sidebar>

		<flux:header class="lg:hidden">
			<flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
		</flux:header>

		<flux:main>
			{{ $slot }}
		</flux:main>

		<flux:toast />

		@fluxScripts
    </body>
</html>
