<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/*************************************************** AJAX INTRERFACE ***********************************************/
$route['admin/login'] = "ajax_interface/login_in";
$route['administrator/profile/save'] = "ajax_interface/profileSave";

/*********** news ***************/
$route['administrator/news/insert'] = "ajax_interface/insertNews";
$route['administrator/news/update'] = "ajax_interface/updateNews";
$route['university/news/delete'] = "ajax_interface/deleteNews";

$route['administrator/news/insert/images'] = "ajax_interface/saveNewsPhoto";
$route['administrator/news/images/delete'] = "ajax_interface/deleteNewsPhoto";
/*************************************************** USERS INTRERFACE ***********************************************/

$route['events'] = "users_interface/events";
$route['projects'] = "users_interface/projects";
$route['object/partners'] = "users_interface/objectPartners";
$route['object/photos'] = "users_interface/objectPhotos";
$route['object/project'] = "users_interface/objectProject";
$route['people'] = "users_interface/people";
$route['contacts'] = "users_interface/contacts";

$route['admin'] = "users_interface/login";
$route['logoff'] = "users_interface/logoff";
/*************************************************** ADMIN INTRERFACE ***********************************************/

$route[ADM_START_PAGE] = "admin_interface/control_panel";
$route['administrator/profile'] = "admin_interface/profile";
/*********** news ***************/
$route['administrator/news'] = "admin_interface/listNews";
$route['administrator/news/offset'] = "admin_interface/listNews";
$route['administrator/news/offset/:num'] = "admin_interface/listNews";
$route['administrator/news/add'] = "admin_interface/insertNews";
$route['administrator/news/edit/:num'] = "admin_interface/editNews";
$route['administrator/news/edit'] = "admin_interface/editNews";
$route['administrator/news/edit/images/:num'] = "admin_interface/editNewsImages";
$route['administrator/news/edit/images'] = "admin_interface/editNewsImages";