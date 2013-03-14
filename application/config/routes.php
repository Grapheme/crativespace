<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/*************************************************** AJAX INTRERFACE ***********************************************/
$route['admin/login'] = "ajax_interface/login_in";
$route['administrator/profile/save'] = "ajax_interface/profileSave";

/*********** news ***************/
$route['administrator/news/insert'] = "ajax_interface/insertNews";
$route['administrator/news/update'] = "ajax_interface/updateNews";
$route['administrator/news/delete'] = "ajax_interface/deleteNews";

$route['administrator/news/insert/images'] = "ajax_interface/saveNewsPhoto";
$route['administrator/news/images/delete'] = "ajax_interface/deleteNewsPhoto";
/*********** news ***************/
$route['administrator/event/insert'] = "ajax_interface/insertEvent";
$route['administrator/event/update'] = "ajax_interface/updateEvent";
$route['administrator/event/delete'] = "ajax_interface/deleteEvent";

$route['administrator/events/save/photo'] = "ajax_interface/updateEventPhoto";
/*********** projects ***************/
$route['administrator/project/insert'] = "ajax_interface/insertProject";
$route['administrator/project/update'] = "ajax_interface/updateProject";
$route['administrator/project/delete'] = "ajax_interface/deleteProject";

$route['administrator/projects/save/photo'] = "ajax_interface/updateProjectPhoto";
/*************************************************** USERS INTRERFACE ***********************************************/
/********** loading image *************/
$route['loadimage/:any/:num'] = "users_interface/loadimage";
/************** pages ****************/
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
/*********** events ***************/
$route['administrator/events'] = "admin_interface/listEvents";
$route['administrator/events/offset'] = "admin_interface/listEvents";
$route['administrator/events/offset/:num'] = "admin_interface/listEvents";
$route['administrator/events/add'] = "admin_interface/insertEvent";
$route['administrator/events/edit/:num'] = "admin_interface/editEvent";
$route['administrator/events/edit'] = "admin_interface/editEvent";
/*********** projects ***************/
$route['administrator/projects'] = "admin_interface/listProjects";
$route['administrator/projects/offset'] = "admin_interface/listProjects";
$route['administrator/projects/offset/:num'] = "admin_interface/listProjects";
$route['administrator/projects/add'] = "admin_interface/insertProject";
$route['administrator/projects/edit/:num'] = "admin_interface/editProject";
$route['administrator/projects/edit'] = "admin_interface/editProject";