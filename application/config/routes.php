<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['auth'] => ini buat redirect('auth'); 

// Login
$route['auth'] = 'Auth/login'; // Controller/view-nya
$route['admin_login'] = 'auth/admin_login';
$route['auth_process'] = 'Auth/auth_process'; // biar bisa form_open harus di route dulu

// Admin
$route['admin'] = 'Admin/index'; // Controller/function
// application/config/routes.php


// HRD
$route['dosen'] = 'Dosen/index'; // Controller/view-nya

// Karyawan
$route['mahasiswa'] = 'Mahasiswa/index'; // Controller/view-nya

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dosen1/edit/(:num)'] = 'dosen1/edit/$1';
$route['dosen1/delete/(:num)'] = 'dosen1/delete/$1';