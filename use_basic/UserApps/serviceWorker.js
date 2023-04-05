var static = "oneuiux-v2 Shop";
var cacheassets = [
    "/splash.php",
    "/landing.php",
    "/signin.php",
    "/signup.php",
    "/verify.php",
    "/thankyou.php",
    "/stats.php",
    "/style.php",
    "/profile.php",
    "/assets/css/style.css",
    "/assets/js/app.js",
    "/assets/js/color-scheme.js",
    "/assets/js/jquery-3.33.111.min.js",
    "/assets/js/jquery.cookie.js",
    "/assets/js/main.js",
    "/assets/js/popper.min.js",
    "/assets/js/pwa-services.js",
];

self.addEventListener("install", function (event) {
    event.waitUntil(
        caches.open(static).then(function (cache) {
            cache.addAll(cacheassets);
        }).then(function () {
            return self.skipWaiting();
        })
    );
});
self.addEventListener("activate", function (event) {});

self.addEventListener("fetch", function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request)
        })
    );
});