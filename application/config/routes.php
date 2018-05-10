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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'dashboard/login';
$route['dashboard/login']['get'] = 'dashboard/login';
$route['dashboard/login']['post'] = 'dashboard/login/do_login';
$route['dashboard/logout'] = 'dashboard/login/logout';
$route['dashboard/change_password']['get'] = 'dashboard/login/change_password';
$route['dashboard/change_password']['post'] = 'dashboard/login/do_change_password';


$route['dashboard/collection/add']['get'] = 'dashboard/collection/add';
$route['dashboard/collection/add']['post'] = 'dashboard/collection/do_add';
$route['dashboard/collection/edit']['post'] = 'dashboard/collection/do_edit';
$route['dashboard/collection/favorite']['post'] = 'dashboard/collection/do_favorite';
$route['dashboard/collection/view/(:any)']['get'] = 'dashboard/collection/view/$1';

$route['dashboard/collection/category/add']['post'] = 'dashboard/collection/do_add_category';
$route['dashboard/collection/category/edit']['post'] = 'dashboard/collection/do_edit_category';
$route['dashboard/collection/category/delete']['post'] = 'dashboard/collection/do_delete_category';

$route['dashboard/garment/add']['POST'] = 'dashboard/garment/doInsert';
$route['dashboard/garment/update']['POST'] = 'dashboard/garment/doEditGarment';






