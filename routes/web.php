<?php


$router->get('/auth/login', 'AuthController@index');
$router->get('/auth/google', 'AuthController@googleLogin');
$router->get('/auth/google/callback', 'AuthController@googleCallback');
$router->get('/auth/logout', 'AuthController@logout', 'AuthMiddleware');


$router->get('/', 'DashboardController@index', 'AuthMiddleware');

$router->get('/tasks', 'TaskController@index', 'AuthMiddleware');
$router->post('/tasks/store', 'TaskController@store', 'AuthMiddleware');
$router->post('/tasks/update', 'TaskController@update', 'AuthMiddleware');
$router->post('/tasks/update-status', 'TaskController@updateStatus', 'AuthMiddleware');

$router->get('/projects', 'ProjectController@index', 'AuthMiddleware');

$router->get('/settings', 'SettingController@index', 'AuthMiddleware');
$router->post('/settings/update', 'SettingController@update', 'AuthMiddleware');

$router->get('/calendar', 'CalendarController@index', 'AuthMiddleware');
$router->get('/analytics', 'AnalyticController@index', 'AuthMiddleware');