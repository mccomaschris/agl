# Make AGL Feel More Like an App

## Context
Most league members access AGL on their phones. The app has a solid PWA foundation (manifest, splash screens, icons, meta tags) but is missing several things that make a web app feel native. This plan prioritizes changes by impact.

---

## Improvements, Ranked by Impact

### 1. Bottom Navigation Bar (Highest Impact)
The single biggest signal of a native app on mobile. Replace the hamburger-only menu with a sticky bottom tab bar visible only on mobile (`lg:hidden`).

**Tabs (5 max):**
- Home (`/`)
- Standings
- Handicaps
- Scores (current week)
- More (hamburger → existing top nav)

**Implementation:**
- Add a partial/include at the bottom of `resources/views/components/layouts/app.blade.php`
- Use Tailwind `fixed bottom-0 inset-x-0` with safe-area padding
- Active state via `request()->routeIs()`
- Add `pb-safe` bottom padding to `<body>` so content isn't hidden behind the nav

**Files:** `resources/views/components/layouts/app.blade.php`, new `resources/views/components/bottom-nav.blade.php`

---

### 2. SPA-like Navigation with `wire:navigate`
Eliminates full page reloads between Livewire pages — navigation feels instant like a native app. Livewire's `wire:navigate` is already available (Livewire 4).

**Implementation:**
- Add `wire:navigate` to nav links in `resources/views/components/layouts/app.blade.php` (both desktop and mobile nav) and the bottom nav
- Livewire handles the page transitions automatically

**Files:** `resources/views/components/layouts/app.blade.php`, `resources/views/components/main.blade.php`

---

### 3. Fix Web Manifest
Two quick fixes with visible impact:

- **Typo:** `"Appliance Golf Leage"` → `"Appliance Golf League"`
- **theme_color:** `"#ffffff"` → `"#04954A"` (green) — controls browser chrome color on Android when installed
- **Add SVG icon** to icons array alongside the PNGs

**File:** `public/site.webmanifest`

---

### 4. iOS Status Bar & Safe Area
Makes the app feel more immersive when added to the iOS home screen.

- Add `<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">`
- Change viewport to include `viewport-fit=cover`
- Add `padding-bottom: env(safe-area-inset-bottom)` to bottom nav

**File:** `resources/views/components/layouts/app.blade.php`

---

### 5. Fix & Register the Service Worker
The existing `public/service-worker.js` is broken (references `/css/app.css`, `/js/app.js` which don't exist) and is never registered anywhere in the HTML. A working service worker enables faster repeat visits and an offline fallback page.

**Implementation:**
- Rewrite `service-worker.js` with a **network-first** strategy for HTML and **cache-first** for static assets (CSS, fonts, images)
- Add a simple `/offline` route and Blade view as the fallback
- Register the service worker via `<script>` in `app.blade.php`

**Files:** `public/service-worker.js`, `resources/views/components/layouts/app.blade.php`, new offline route + view

---

### 6. Mobile Table Scrolling (Usability)
Key pages (Team Points, Handicaps) have wide tables that require horizontal scrolling with no visual indicator. Add scroll shadow indicators so users know the table continues.

**Implementation:**
- Wrap tables in a div with `overflow-x-auto` and a CSS scroll-shadow (using `::after` pseudo-element with a gradient)
- Already done partially — just needs to be consistent across all table pages

**Files:** `resources/assets/css/_tables.css`

---

## Recommended Order of Implementation

1. Fix web manifest (5 min, immediate visible improvement on Android)
2. Bottom navigation bar (biggest UX win)
3. `wire:navigate` on nav links (instant navigation feel)
4. iOS status bar + safe area meta tags (pairs naturally with bottom nav)
5. Service worker fix (enables offline/faster loads)
6. Table scroll improvements (usability polish)

## Verification
- Install the app to iOS home screen — check splash screen, status bar, bottom nav, theme color
- Install on Android — check `theme_color` in browser chrome, installability
- Navigate between pages — should feel instant with `wire:navigate`
- Disable network — should show offline page (after service worker fix)

## Status

| # | Item | Status |
|---|------|--------|
| 1 | Bottom navigation bar | ✅ done |
| 2 | `wire:navigate` on nav links | ✅ done |
| 3 | Fix web manifest | ✅ done |
| 4 | iOS status bar + safe area | ✅ done |
| 5 | Service worker fix | ✅ done |
| 6 | Table scroll improvements | ✅ done |
