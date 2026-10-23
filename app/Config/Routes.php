<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard/summary', 'Dashboard::getSummary');
$routes->get('/chat', 'Chat::index');
$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/saas', 'Saas::index');
$routes->get('/master_menu', 'MasterMenu::index');
$routes->get('/users', 'Users::index');
$routes->get('/settings', 'Settings::index');
$routes->get('/settings/wa_group', 'Settings::getWaGroupSettings');
$routes->match(['post', 'put'], '/settings/wa_group', 'Settings::saveWaGroupSettings');
$routes->get('/villages', 'Villages::index');
$routes->match(['delete', 'post'], '/villages/(:segment)', 'Villages::delete/$1');
$routes->match(['delete', 'post'], '/villages/delete/(:segment)', 'Villages::delete/$1');
$routes->match(['post', 'get'], '/villages/notify/(:segment)', 'Villages::notifyChat/$1');
$routes->match(['post', 'get'], '/villages/(:segment)/notify', 'Villages::notifyChat/$1');
$routes->get('/security', 'Security::index');
$routes->get('/activity_logs', 'ActivityLogs::index');
$routes->get('/activity_logs/data', 'ActivityLogs::getData');
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

