<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->add('room/type/add', 'RoomType::add');
$routes->add('room/type/(:any)/delete', 'RoomType::delete/$1');
$routes->add('room/type/(:any)/edit', 'RoomType::edit/$1');
$routes->add('room/type', 'RoomType::index');


$routes->add('room/type', 'RoomType::index');
$routes->add('room/type/add', 'RoomType::add');
$routes->add('room/type/(:any)/delete', 'RoomType::delete/$1');
$routes->add('room/type/(:any)/edit', 'RoomType::edit/$1');


$routes->add('payment/type', 'PaymentType::index');
$routes->add('payment/type/add', 'PaymentType::add');
$routes->add('payment/type/(:any)/delete', 'PaymentType::delete/$1');
$routes->add('payment/type/(:any)/edit', 'PaymentType::edit/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
