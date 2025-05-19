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

// Rutas de usuarios (admin)
$routes->get('usuarios/admin/list', 'UsuariosAdminController::index');
$routes->get('usuarios/admin/crear', 'UsuariosAdminController::crear');
$routes->get('usuarios/admin/doEliminar/(:segment)', 'UsuariosAdminController::doEliminar/$1');
$routes->get('usuarios/admin/editar/(:segment)', 'UsuariosAdminController::editar/$1');
$routes->get('usuarios/admin/ver/(:segment)', 'UsuariosAdminController::ver/$1');
$routes->post('usuarios/admin/doCrear', 'UsuariosAdminController::doCrear');
$routes->post('usuarios/admin/doEditar/(:segment)', 'UsuariosAdminController::doEditar/$1');

// Rutas de usuarios (usuario)
$routes->get('usuarios', 'UsuariosController::index');
$routes->get('usuarios/ver/(:segment)', 'UsuariosController::ver/$1');

// Rutas de película (admin)
$routes->post('peliculas/admin/doCrear', 'PeliculasController::doCrear');
$routes->get('peliculas/admin/crear', 'PeliculasController::crear');
$routes->get('peliculas/admin/editar/(:segment)', 'PeliculasController::editar/$1');
$routes->post('peliculas/admin/doEditar/(:segment)', 'PeliculasController::doEditar/$1');
$routes->get('peliculas/admin/ver/(:segment)', 'PeliculasController::ver/$1');
$routes->get('peliculas/admin/list', 'PeliculasController::index');
$routes->get('peliculas/admin/doEliminar/(:segment)', 'PeliculasController::doEliminar/$1');

// Rutas de cines (admin)
$routes->post('cines/admin/doCrear', 'CinesController::doCrear');
$routes->get('cines/admin/crear', 'CinesController::crear');
$routes->get('cines/admin/editar/(:segment)', 'CinesController::editar/$1');
$routes->post('cines/admin/doEditar/(:segment)', 'CinesController::doEditar/$1');
$routes->get('cines/admin/ver/(:segment)', 'CinesController::ver/$1');
$routes->get('cines/admin/list', 'CinesController::index');
$routes->get('cines/admin/doEliminar/(:segment)', 'CinesController::doEliminar/$1');

// Rutas de Salas (admin)
$routes->post('salas/admin/doCrear', 'SalasController::doCrear');
$routes->get('salas/admin/crear', 'SalasController::crear');
$routes->get('salas/admin/editar/(:segment)', 'SalasController::editar/$1');
$routes->post('salas/admin/doEditar/(:segment)', 'SalasController::doEditar/$1');
$routes->get('salas/admin/ver/(:segment)', 'SalasController::ver/$1');
$routes->get('salas/admin/list', 'SalasController::index');
$routes->get('salas/admin/doEliminar/(:segment)', 'SalasController::doEliminar/$1');
$routes->get('salas/admin/estructura/(:segment)', 'SalasController::estructura/$1');
$routes->post('salas/admin/doEstructura/(:segment)', 'SalasController::doEstructura/$1');
$routes->get('salas/admin/estructura', 'SalasController::estructura');


// Rutas de Funciones (admin)
$routes->post('funciones/admin/doCrear', 'FuncionesController::doCrear');
$routes->get('funciones/admin/crear', 'FuncionesController::crear');
$routes->get('funciones/admin/editar/(:segment)', 'FuncionesController::editar/$1');
$routes->post('funciones/admin/doEditar/(:segment)', 'FuncionesController::doEditar/$1');
$routes->get('funciones/admin/ver/(:segment)', 'FuncionesController::ver/$1');
$routes->get('funciones/admin/list', 'FuncionesController::index');
$routes->get('funciones/admin/doEliminar/(:segment)', 'FuncionesController::doEliminar/$1');

// // Mis reservas (solo usuario logueado)
// $routes->get('mis-reservas', 'Reservas::misReservas');

// // Crear reserva (cualquier usuario logueado)
// $routes->get('reservas/crear', 'Reservas::crear');
// $routes->post('reservas/store', 'Reservas::store');

// // Crear función (solo admin)
// $routes->get('funciones/create', 'Funciones::create');
// $routes->post('funciones/store', 'Funciones::store');

// // Crear sala (solo admin)
// $routes->get('salas/create', 'Salas::create');
// $routes->post('salas/store', 'Salas::store');

// // Crear butaca (solo admin)
// $routes->get('butacas/create', 'Butacas::create');
// $routes->post('butacas/store', 'Butacas::store');
