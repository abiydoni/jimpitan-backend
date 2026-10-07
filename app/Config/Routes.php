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
$routes->get('/security', 'Security::index');
$routes->get('/wa_blast', 'WaBlast::index');
$routes->get('/wa_blast/villages', 'WaBlast::getVillages');
$routes->get('/wa_blast/recipients', 'WaBlast::getRecipients');
$routes->get('/wa_blast/settings', 'WaBlast::getSettings');
$routes->match(['post', 'put'], '/wa_blast/settings', 'WaBlast::saveSettings');
$routes->post('/wa_blast/test', 'WaBlast::testSend');
$routes->post('/wa_blast/send_single', 'WaBlast::sendSingle');
$routes->post('/wa_blast/record_history', 'WaBlast::recordHistory');
$routes->post('/wa_blast/send', 'WaBlast::sendBlast');
$routes->post('/wa_blast/blast', 'WaBlast::sendBlast');
$routes->get('/wa_blast/history', 'WaBlast::getHistory');
$routes->match(['delete', 'post'], '/wa_blast/history/(:segment)', 'WaBlast::deleteHistory/$1');

