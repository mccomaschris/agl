@props(['route', 'params' => [], 'activeClass' => 'border-white text-white', 'defaultClass' => 'border-transparent text-white/80 hover:border-green-800 hover:text-white'])

<a href="{{ route($route, $params) }}"
   class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium
   {{ request()->routeIs($route) ? $activeClass : $defaultClass }}">
   {{ $slot }}
</a>
