<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Dashboard::index');
$routes->get('/chat', 'Chat::index');
$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/saas', 'Saas::index');
$routes->get('/master_menu', 'MasterMenu::index');
$routes->get('/users', 'Users::index');
$routes->get('/settings', 'Settings::index');
$routes->get('/villages', 'Villages::index');
