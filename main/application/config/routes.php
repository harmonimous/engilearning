<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['dosen/login'] = 'dosen/dosen/login';
$route['dosen/logout'] = 'dosen/dosen/logout';

$route['login'] = 'login';
$route['logout'] = 'login/logout';

$route['matakuliah/hal'] = "matakuliah/index/hal";
$route['matakuliah/hal/(:num)'] = "matakuliah/index/hal/$1";
$route['matakuliah/(:any)'] = "matakuliah/kategori/$1";
$route['matakuliah/(:any)/hal'] = "matakuliah/kategori/$1/hal";
$route['matakuliah/(:any)/hal/(:num)'] = "matakuliah/kategori/$1/hal/$2";

$route['diskusi/(:num)'] = 'diskusi/index/$1';
$route['diskusi/(:num)/(:any)'] = 'diskusi/index/$1/komentari';

$route['mahasiswa/tugas/(:num)'] = 'mahasiswa/tugas/index/$1';
$route['mahasiswa/tugas/(:num)/(:any)'] = 'mahasiswa/tugas/index/$1/jawab';

$route['mahasiswa/learn/(:num)'] = 'mahasiswa/learn/index/$1';
$route['mahasiswa/learn/(:num)/(:any)'] = 'mahasiswa/learn/index/$1/read';
$route['mahasiswa/learn/(:num)/(:any)/(:num)'] = 'mahasiswa/learn/index/$1/hal/$2';

$route['mahasiswa/learn/start/(:num)/(:num)'] = 'mahasiswa/learn/start/$1/$2';
$route['default_controller'] = 'home';
$route['404_override'] = 'error/error404';
$route['translate_uri_dashes'] = FALSE;
