<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/admin', function () {
//     echo 'mantap';
// }, ['as' => 'home', 'filter' => 'auth:admin']);

$routes->get('/', 'Home::index', ['as' => 'home', 'filter' => 'auth']);
$routes->get('/api/terlaksana', 'Home::terlaksana', ['as' => 'api-terlaksana', 'filter' => 'auth']);
$routes->post('/pdf/spt', 'PdfController::spt', ['as' => 'pdf-spt', 'filter' => 'auth']);
$routes->post('/pdf/kwitansi', 'PdfController::kwitansi', ['as' => 'pdf-kwitansi', 'filter' => 'auth']);

// Users Section
$routes->get('/users', 'Users::index', ['as' => 'users', 'filter' => 'auth:admin']);
$routes->post('/users/add', 'Users::add', ['as' => 'users-add', 'filter' => 'auth:admin']);
$routes->post('/users/delete', 'Users::delete', ['as' => 'users-delete', 'filter' => 'auth:admin']);
$routes->post('/users/update', 'Users::update', ['as' => 'users-update', 'filter' => 'auth:admin']);

// Authentication Section
$routes->get('/login', 'Auth::index', ['as' => 'login']);
$routes->post('/login/auth', 'Auth::auth', ['as' => 'auth']);
$routes->get('/logout', 'Auth::logout', ['as' => 'logout']);

// Setting Section
$routes->get('/setting', 'Setting::index', ['as' => 'setting', 'filter' => 'auth']);
$routes->post('/setting/update', 'Setting::update', ['as' => 'setting-update', 'filter' => 'auth']);

// Hasil Section
$routes->get('/hasil', 'Hasil::index', ['as' => 'hasil', 'filter' => 'auth']);
$routes->get('/hasil/add', 'Hasil::add', ['as' => 'hasil-add', 'filter' => 'auth:admin,user']);
$routes->post('/hasil/save', 'Hasil::save', ['as' => 'hasil-save', 'filter' => 'auth']);

// Surat Section
$routes->get('/diajukan', 'Surat::index', ['as' => 'diajukan', 'filter' => 'auth']);
$routes->get('/diajukan/add', 'Surat::add', ['as' => 'diajukan-add', 'filter' => 'auth:admin,user']);
$routes->get('/diajukan/edit/(:num)', 'Surat::edit/$1', ['as' => 'diajukan-edit', 'filter' => 'auth']);
$routes->get('/diajukan/detail/(:num)', 'Surat::show/$1', ['as' => 'diajukan-show', 'filter' => 'auth']);
$routes->post('/diajukan/save', 'Surat::save', ['as' => 'diajukan-save', 'filter' => 'auth']);
$routes->post('/diajukan/update', 'Surat::update', ['as' => 'diajukan-update', 'filter' => 'auth']);
$routes->post('/diajukan/delete', 'Surat::delete', ['as' => 'diajukan-delete', 'filter' => 'auth']);
$routes->post('/diajukan/accept', 'Surat::accept', ['as' => 'diajukan-accept', 'filter' => 'auth:admin']);

$routes->get('/diterima', 'Surat::diterima', ['as' => 'diterima', 'filter' => 'auth']);
$routes->post('/diterima/finish', 'Surat::finish', ['as' => 'diterima-finish', 'filter' => 'auth']);

$routes->get('/selesai', 'Surat::selesai', ['as' => 'selesai', 'filter' => 'auth']);

// Pegawai Section
$routes->post('/pegawai/save', 'Pegawai::save', ['as' => 'pegawai-save', 'filter' => 'auth']);
$routes->post('/pegawai/update', 'Pegawai::update', ['as' => 'pegawai-update', 'filter' => 'auth']);
$routes->post('/pegawai/delete', 'Pegawai::delete', ['as' => 'pegawai-delete', 'filter' => 'auth']);

// Kwitansi Section
$routes->get('/kwitansi', 'Kwitansi::index', ['as' => 'kwitansi', 'filter' => 'auth']);
$routes->post('/kwitansi/save', 'Kwitansi::save', ['as' => 'kwitansi-save', 'filter' => 'auth']);
$routes->post('/kwitansi/update', 'Kwitansi::update', ['as' => 'kwitansi-update', 'filter' => 'auth']);
$routes->post('/kwitansi/accept', 'Kwitansi::accept', ['as' => 'kwitansi-accept', 'filter' => 'auth:admin']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
