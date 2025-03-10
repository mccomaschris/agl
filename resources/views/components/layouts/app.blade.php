<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#04954A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link href="/images/splash/iphone5_splash.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/splash/iphone6_splash.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/splash/iphoneplus_splash.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/images/splash/iphonex_splash.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/images/splash/iphonexr_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/splash/iphonexsmax_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/images/splash/ipad_splash.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/splash/ipadpro1_splash.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/splash/ipadpro3_splash.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/splash/ipadpro2_splash.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

	<link rel="stylesheet" href="{{ twcss('/css/main.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<style>
		[x-cloak] { display: none !important; }
	</style>

</head>
<body
	class="h-screen font-sans mb-20 pb-10 bg-gray-100 @yield('body-css')"
	x-data="{ mobileOpen: false }"
>
    <div id="app" class="pb-12">
		<nav class="bg-green-500 shadow-sm">
			<div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
				<div class="relative flex h-16 justify-between">
					<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
				  		<!-- Mobile menu button -->
						<button @click="mobileOpen = !mobileOpen" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-gray-100 hover:text-gray-100 focus:ring-2 focus:ring-white-500 focus:outline-hidden focus:ring-inset" aria-controls="mobile-menu" aria-expanded="false">
							<span class="absolute -inset-0.5"></span>

							<span class="sr-only">Open main menu</span>

							<svg x-show="!mobileOpen" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
							</svg>

							<svg x-cloak x-show="mobileOpen" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
							</svg>
						</button>
					</div>

					<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
						<div class="flex shrink-0 items-center">
							<a href="/">
								<svg class="text-white fill-current size-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 512"><path fill="currentColor" d="M96 416h224c0 17.7-14.3 32-32 32h-16c-17.7 0-32 14.3-32 32v20c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-20c0-17.7-14.3-32-32-32h-16c-17.7 0-32-14.3-32-32zm320-208c0 74.2-39 139.2-97.5 176h-221C39 347.2 0 282.2 0 208 0 93.1 93.1 0 208 0s208 93.1 208 208zm-180.1 43.9c18.3 0 33.1-14.8 33.1-33.1 0-14.4-9.3-26.3-22.1-30.9 9.6 26.8-15.6 51.3-41.9 41.9 4.6 12.8 16.5 22.1 30.9 22.1zm49.1 46.9c0-14.4-9.3-26.3-22.1-30.9 9.6 26.8-15.6 51.3-41.9 41.9 4.6 12.8 16.5 22.1 30.9 22.1 18.3 0 33.1-14.9 33.1-33.1zm64-64c0-14.4-9.3-26.3-22.1-30.9 9.6 26.8-15.6 51.3-41.9 41.9 4.6 12.8 16.5 22.1 30.9 22.1 18.3 0 33.1-14.9 33.1-33.1z"></path></svg>
							</a>
						</div>

						<div class="hidden sm:ml-6 sm:flex sm:space-x-4">
							<a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Team Points</a>
							<a href="{{ route('handicaps', ['year' => $activeYear->name]) }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Handicaps</a>
							<a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Group Stats</a>
							<a href="{{ route('team-stats', ['year' => $activeYear->name]) }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Team Stats</a>
							{{-- <a href="{{ route('standings', ['year' => $activeYear->name]) }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Standings</a> --}}
							<a href="{{ route('schedule', ['year' => $activeYear->name]) }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Schedule</a>
							<a href="{{ route('rules') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Rules</a>
							<a href="{{ route('history') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">History &amp; Records</a>
							@if(Auth::check())
								<a href="{{ route('waitlist.index') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Waitlist</a>
								<a href="{{ route('members') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-100 hover:border-gray-50 hover:text-white">Members</a>
							@endif
						</div>
					</div>
					<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
						<div class="relative ml-3">
							@if(Auth::check())
							<form action="{{ route('logout') }}" method="POST" class="lg:inline-block">
								{{ csrf_field() }}
								<button type="submit" class="rounded-sm bg-white px-2 py-1 text-sm font-semibold text-green-500 shadow-xs hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Logout</button>
							</form>
							@else
								<a href="{{ route('login') }}" class="rounded-sm bg-white px-2 py-1 text-sm font-semibold text-green-500 shadow-xs hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Login</a>
							@endif
						</div>
					</div>
				</div>
			</div>


			<div x-show="mobileOpen" x-cloak id="mobile-menu">
			  	<div class="space-y-1 pt-2 pb-4">
					<a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Team Points</a>
					<a href="{{ route('handicaps', ['year' => $activeYear->name]) }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Handicaps</a>
					<a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Group Stats</a>
					<a href="{{ route('team-stats', ['year' => $activeYear->name]) }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Team Stats</a>
					<a href="{{ route('standings', ['year' => $activeYear->name]) }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Standings</a>
					<a href="{{ route('schedule', ['year' => $activeYear->name]) }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Schedule</a>
					<a href="{{ route('rules') }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Rules</a>
					<a href="{{ route('history') }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">History &amp; Records</a>
					@if(Auth::check())
						<a href="{{ route('waitlist.index') }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Waitlist</a>
						<a href="{{ route('members') }}" class="block border-l-4 border-green-800 bg-green-500 py-2 pr-4 pl-3 text-base font-medium text-white">Members</a>
					@endif
				</div>
			</div>
		</nav>

        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
			@if (isset($header))
                {{ $header }}
            @endif

            {{ $slot }}
        </div>
    </div>
</body>
</html>
