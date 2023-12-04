<?php

use App\Controllers\Api\Alat;
use App\Controllers\Api\Kategori;
use App\Controllers\Frontend\Dashboard;
use App\Controllers\Migrate;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Dashboard::class, 'index']);

service('auth')->routes($routes);

$routes->environment('development', static function ($routes) {
    $routes->get('migrate', [Migrate::class, 'index']);
});

$routes->environment('production', static function ($routes) {
    $routes->get('migrate', function () {
        return 'Haha';
    });
});

$routes->group('api', ['namespace' => ''], static function ($routes) {
    $routes->resource('kategori', ['controller' => Kategori::class, 'websafe' => 1]);
    $routes->resource('alat', ['controller' => Alat::class, 'websafe' => 1]);
});



$routes->group('alat',  static function ($routes) {
    $routes->get('', [Dashboard::class, 'alat']);
    $routes->get('tambah', [Dashboard::class, 'alatForm']);
    $routes->get('edit/(:num)', [Dashboard::class, 'alatForm']);
});

$routes->group('kategori',  static function ($routes) {
    $routes->get('', [Dashboard::class, 'kategori']);
    $routes->get('tambah', [Dashboard::class, 'kategoriForm']);
    $routes->get('edit/(:num)', [Dashboard::class, 'kategoriForm']);
});
