<nav
    class="fixed bottom-0 inset-x-0 z-50 bg-white border-t border-zinc-200 flex sm:hidden"
    style="padding-bottom: env(safe-area-inset-bottom)"
>
    <a href="{{ route('home') }}" wire:navigate
       class="flex-1 flex flex-col items-center justify-center py-2 gap-0.5 text-xs font-medium {{ request()->routeIs('home') ? 'text-green-600' : 'text-zinc-500' }}">
        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Home
    </a>

    <a href="{{ route('standings', ['year' => $activeYear->name]) }}" wire:navigate
       class="flex-1 flex flex-col items-center justify-center py-2 gap-0.5 text-xs font-medium {{ request()->routeIs('standings') ? 'text-green-600' : 'text-zinc-500' }}">
        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        Standings
    </a>

    <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}" wire:navigate
       class="flex-1 flex flex-col items-center justify-center py-2 gap-0.5 text-xs font-medium {{ request()->routeIs('handicaps') ? 'text-green-600' : 'text-zinc-500' }}">
        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Handicaps
    </a>

    <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" wire:navigate
       class="flex-1 flex flex-col items-center justify-center py-2 gap-0.5 text-xs font-medium {{ request()->routeIs('team-points') ? 'text-green-600' : 'text-zinc-500' }}">
        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Points
    </a>

    <button
        type="button"
        @click="mobileOpen = !mobileOpen; if (mobileOpen) window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="flex-1 flex flex-col items-center justify-center py-2 gap-0.5 text-xs font-medium text-zinc-500"
    >
        <svg x-show="!mobileOpen" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="mobileOpen" x-cloak class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12" />
        </svg>
        More
    </button>
</nav>
