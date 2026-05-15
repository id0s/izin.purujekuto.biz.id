<?php

use CodeIgniter\Router\RouteCollection;
$routes->setAutoRoute(false); // Pastikan ini 'false' jika kamu ingin pakai route manual

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');// Route Login & Logout
$routes->get('izin', 'Izin::index');
$routes->get('izin/riwayat', 'Izin::riwayat'); // Untuk melihat riwayat
$routes->post('izin/simpan', 'Izin::simpan'); // Khusus untuk menerima kiriman form
$routes->get('izin/rekap', 'Izin::rekap');       // Untuk guru lihat tabel
$routes->post('izin/simpan', 'Izin::simpan');    // Proses simpan data
$routes->get('izin/rekap', 'Izin::rekap'); // Pastikan mengarah ke view monitor_izin
$routes->get('izin/update_status/(:num)/(:any)', 'Izin::update_status/$1/$2');
$routes->get('login', 'Auth::login');
$routes->post('auth/proses_login', 'Auth::proses_login');
$routes->get('logout', 'Auth::logout');
$routes->get('izin/setujui/(:num)', 'Izin::setujui/$1');
$routes->get('izin/tolak/(:num)', 'Izin::tolak/$1');
$routes->get('izin/cetak/(:num)', 'Izin::cetak_pdf/$1');
$routes->get('izin/status', 'Izin::status'); // Untuk melihat riwayat
$routes->get('/izin/validasi/(:num)', 'Izin::validasi/$1');

