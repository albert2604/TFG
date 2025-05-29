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
$routes->post('auth/doRegister', 'AuthController::doRegister');

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
$routes->get('reservar/', 'UsuariosController::crear');
$routes->get('cartelera/', 'UsuariosController::verCartelera');
$routes->get('cartelera/pelicula/(:segment)', 'UsuariosController::verPelicula/$1');

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

// Rutas de reserevas (admin)
$routes->get('reservas/admin/crear', 'ReservasController::crear');
$routes->get('reservas/mis-reservas/(:segment)', 'ReservasController::misReservas/$1');
$routes->get('reservas/admin/editar/(:segment)', 'ReservasController::editar/$1');
$routes->post('reservas/admin/doEditar/(:segment)', 'ReservasController::doEditar/$1');
$routes->get('reservas/admin/ver/(:segment)', 'ReservasController::ver/$1');
$routes->get('reservas/admin/list', 'ReservasController::index');
$routes->get('reservas/admin/doEliminar/(:segment)', 'ReservasController::doEliminar/$1');


$routes->get('wizard', 'WizardController::index');
$routes->post('wizard/doCrear', 'WizardController::doCrear');
$routes->get('wizard/filtrar/(:segment)', 'WizardController::filtrarFunciones/$1');
$routes->get('wizard/filtrar/(:segment)/(:segment)', 'WizardController::filtrarFunciones/$1/$2');
$routes->get('wizard/estructura/(:segment)/(:segment)', 'WizardController::obtenerEstructura/$1/$2');

// Payments

$routes->get('payment/(:segment)/create', 'PaymentController::checkout/$1');
$routes->get('payment/(:segment)/success', 'PaymentController::success/$1');
$routes->get('payment/(:segment)/cancel', 'PaymentController::cancel/$1');
$routes->get('payment/(:segment)/webhook', 'PaymentController::webhook/$1');
