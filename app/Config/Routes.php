<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

$routes->get('/', 'InicioController::index');
$routes->get('inicio', 'InicioController::index');
$routes->get('quienes-somos', 'QuienesSomosController::index');
$routes->get('servicios', 'ServiciosController::index');
$routes->get('contacto', 'ContactoController::index');
$routes->post('contacto/enviar', 'ContactoController::envieCorreo');

// Sitemap
$routes->get('sitemap.xml', 'SitemapController::index');
$routes->get('sitemap', 'SitemapController::index');
