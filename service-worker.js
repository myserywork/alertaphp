self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open('pwa-cache').then(function(cache) {
            return cache.addAll([
                '/',
                '/index.html',
                '/assets/images/logo-iso.png',
                // Adicione outros recursos que você deseja armazenar em cache, garantindo que os caminhos estejam corretos
            ]).catch(function(error) {
                console.error('Failed to cache resources:', error);
            });
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        })
    );
});
