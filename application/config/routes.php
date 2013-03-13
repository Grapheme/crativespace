<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/*************************************************** AJAX INTRERFACE ***********************************************/

/*************************************************** USERS INTRERFACE ***********************************************/

$route['events'] = "users_interface/events";
$route['projects'] = "users_interface/projects";
$route['object/partners'] = "users_interface/objectPartners";
$route['object/photos'] = "users_interface/objectPhotos";
$route['object/project'] = "users_interface/objectProject";
$route['people'] = "users_interface/people";
$route['contacts'] = "users_interface/contacts";

/*************************************************** ADMIN INTRERFACE ***********************************************/

$route[ADM_START_PAGE] = "admin_interface/control_panel";