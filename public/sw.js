const CACHE_NAME = 'v1';
const urlsToCache = [
  '/',
  '/css/app.css',
  '/js/app.js',
  '/logo/logo192.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
});