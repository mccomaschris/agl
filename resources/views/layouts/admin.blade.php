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

    {{-- <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:300,400,600,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body class="h-screen font-sans mb-20 pb-10 @yield('body-css')">
    <div id="app">
        <!-- NEW NAV START -->
        <div class="bg-green-500">
            <div class="container mx-auto py-6 px-4 xl:px-0">
                <nav class="flex items-center justify-between flex-wrap relative" x-data="{ open: false }">
                    <div class="flex items-center flex-no-shrink text-white mr-6">
                        <a href="/" class="inline-flex items-center">
                            <svg class="text-white fill-current h-6 w-6 mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 416 512"><path fill="currentColor" d="M96 416h224c0 17.7-14.3 32-32 32h-16c-17.7 0-32 14.3-32 32v20c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-20c0-17.7-14.3-32-32-32h-16c-17.7 0-32-14.3-32-32zm320-208c0 74.2-39 139.2-97.5 176h-221C39 347.2 0 282.2 0 208 0 93.1 93.1 0 208 0s208 93.1 208 208zm-180.1 43.9c18.3 0 33.1-14.8 33.1-33.1 0-14.4-9.3-26.3-22.1-30.9 9.6 26.8-15.6 51.3-41.9 41.9 4.6 12.8 16.5 22.1 30.9 22.1zm49.1 46.9c0-14.4-9.3-26.3-22.1-30.9 9.6 26.8-15.6 51.3-41.9 41.9 4.6 12.8 16.5 22.1 30.9 22.1 18.3 0 33.1-14.9 33.1-33.1zm64-64c0-14.4-9.3-26.3-22.1-30.9 9.6 26.8-15.6 51.3-41.9 41.9 4.6 12.8 16.5 22.1 30.9 22.1 18.3 0 33.1-14.9 33.1-33.1z"></path></svg>
                            <span class="font-semibold text-white tracking-tight text-2xl">{{ config('app.name') }}</span>
                        </a>
                    </div>
                    <div class="lg:hidden relative flex">
                        <button class="flex items-center px-3 py-2 border rounded border-white" x-on:click="open = !open">
                            <svg x-show="open == false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="text-white fill-current h-4 w-4"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                            <svg x-show="open == true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="text-white fill-current h-4 w-4"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                        </button>
                    </div>
                    <div class="w-full lg:flex lg:items-center lg:w-auto lg:justify-end">
                        <div class="off-canvas h-full lg:h-auto lg:visible lg:flex bg-green-500 text-sm lg:flex-grow z-50 w-full fixed lg:static left-0 lg:left-auto lg:mt-0 pt-4 lg:pt-0" x-bind:class="{ 'active': open }">
                            <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="nav-item border-t lg:hidden">Team Points</a>
                            <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}" class="nav-item lg:hidden">Handicaps</a>
                            <a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="nav-item lg:hidden">Group Stats</a>
                            <a href="{{ route('team-stats', ['year' => $activeYear->name]) }}" class="nav-item lg:hidden">Team Stats</a>
                            <a href="{{ route('standings', ['year' => $activeYear->name]) }}" class="nav-item lg:hidden">Standings</a>
                            <a href="{{ route('schedule', ['year' => $activeYear->name]) }}" class="nav-item">Schedule</a>
                            <a href="{{ route('rules') }}" class="nav-item">Rules</a>
                            <a href="{{ route('history') }}" class="nav-item">History &amp; Records</a>
                            @if(Auth::check())
                                <a href="{{ route('waitlist.index') }}" class="nav-item">Waitlist</a>
                                <a href="{{ route('members') }}" class="nav-item">Members</a>
                                <form action="{{ route('logout') }}" method="POST" class="lg:inline-block">
                                    {{ csrf_field() }}
                                    <button type="submit" class="nav-item text-left " name="logout">Logout</button>
                                </form>
                                @if (Auth::user()->isAdmin())
                                    <a href="/admin" class="lg:ml-4 nav-item lg:border lg:border-white lg:bg-green-500 hover:bg-white hover:text-green-500">Admin</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="nav-item">Login</a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END NAV START -->

        <div class="hidden lg:block bg-grey-900 py-4 mb-12">
            <div class="w-full lg:max-w-screen-lg xl:max-w-screen-xl mx-auto lg:flex text-sm items-center px-4 xl:px-0">
                <span class="font-semibold mr-4 text-grey-100 uppercase">2021 Stats:</span>
                <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class=" mt-0 text-green-bright hover:text-green-bright hover:underline mr-4">Team Points</a>
                <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}" class=" mt-0 text-green-bright hover:text-green-bright hover:underline mr-4">Handicaps</a>
                <a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class=" mt-0 text-green-bright hover:text-green-bright hover:underline mr-4">Group Stats</a>
                <a href="{{ route('team-stats', ['year' => $activeYear->name]) }}" class=" mt-0 text-green-bright hover:text-green-bright hover:underline mr-4">Team Stats</a>
                <a href="{{ route('standings', ['year' => $activeYear->name]) }}" class=" mt-0 text-green-bright hover:text-green-bright hover:underline mr-4">Standings</a>
            </div>
        </div>

        @yield('jumbotron')

        <div class="px-8">
            @yield('homepage-alert')
            @yield('page-heading')
            @yield('content')
        </div>
    </div>

    @if(session()->has('message.content'))
        <div class="alert" data-controller="flash">
            <svg class="text-green-bright fill-current h-6 w-6 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/></svg>
            <span>{!! session('message.content') !!}</span>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
