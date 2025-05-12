<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

// Ruta
$routes->get('test', 'TestController::index');

// Rutas de autenticación/
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/login', 'AuthController::doLogin');
$routes->get('auth/logout', 'AuthController::logout');
// Registro público
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/register', 'AuthController::doRegister');

// Rutas de usuarios (solo admin puede crear, editar y eliminar)
 $routes->get('usuarios/crear', 'UsuariosAdminController::crear');
// $routes->post('usuarios/store', 'Usuarios::store');
$routes->get('usuarios/ver/(:segment)', 'UsuariosController::ver/$1');
// $routes->post('usuarios/update/(:num)', 'Usuarios::update/$1');
// $routes->get('usuarios/delete/(:num)', 'Usuarios::delete/$1');
// // Listado de usuarios solo para logueados
$routes->get('usuarios/index', 'UsuariosAdminController::index');

// // Mis reservas (solo usuario logueado)
// $routes->get('mis-reservas', 'Reservas::misReservas');

// // Crear reserva (cualquier usuario logueado)
// $routes->get('reservas/crear', 'Reservas::crear');
// $routes->post('reservas/store', 'Reservas::store');


// // Crear película (solo admin)
// $routes->get('peliculas/crear', 'Peliculas::crear');
// $routes->post('peliculas/ver', 'Peliculas::ver');
// $routes->get('peliculas/', 'Peliculas::index');

// // Crear función (solo admin)
// $routes->get('funciones/create', 'Funciones::create');
// $routes->post('funciones/store', 'Funciones::store');

// // Crear sala (solo admin)
// $routes->get('salas/create', 'Salas::create');
// $routes->post('salas/store', 'Salas::store');

// // Crear butaca (solo admin)
// $routes->get('butacas/create', 'Butacas::create');
// $routes->post('butacas/store', 'Butacas::store');
