self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open('agl-static-v2').then(function(cache) {
        return cache.addAll([
            '/css/app.css',
            '/js/app.js',
            '/js/cache.js',
            '/service-worker.js',
            '/',
            '/handicaps',
            '/schedule',
            '/team-points',
            '/group-stats',
            '/team-stats',
            '/standings'
        ]);
        })
    );
});
