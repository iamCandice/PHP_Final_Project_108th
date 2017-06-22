<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
//$route['default_controller'] = 'welcome';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'articles';
$route['sign_up'] = 'users/create';
$route['sign_in'] = 'sessions/create';
$route['sign_out'] = 'sessions/destroy';
$route['articles'] = 'articles/index';
$route['chatbots'] = 'chatbots/index';
$route['chatbots/hot'] = 'chatbots/hot';
$route['chatbots/tag'] = 'chatbots/tag';
$route['chatbots/user_articles'] = 'chatbots/user_articles';
$route['articles/(:num)'] = 'articles/show/$1';
$route['articles/(:num)/edit'] = 'articles/edit/$1';
$route['articles/(:num)/update'] = 'articles/update/$1';
$route['articles/(:num)/destroy'] = 'articles/destroy/$1';
$route['articles/(:num)/comment'] = 'articles/comment/$1';
$route['articles/(:num)/like'] = 'articles/like/$1';
$route['articles/(:num)/dislike'] = 'articles/dislike/$1';
$route['articles/my'] = 'articles/my';
$route['admin/articles'] = 'admin_articles/index';
$route['admin/articles/(:num)/active'] = 'admin_articles/active/$1';
$route['admin/articles/(:num)/refuse'] = 'admin_articles/refuse/$1';
$route['admin/articles/(:num)/destroy'] = 'admin_articles/destroy/$1';
$route['admin/users'] = 'admin_users/index';
$route['admin/users/(:num)'] = 'admin_users/show/$1';
$route['admin/users/(:num)/edit'] = 'admin_users/edit/$1';
$route['admin/users/(:num)/update'] = 'admin_users/update/$1';
$route['admin/users/(:num)/destroy'] = 'admin_users/destroy/$1';
