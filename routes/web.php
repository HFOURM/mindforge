<?php

// Hamam
$router->get('/auth/login', 'AuthController@index');
$router->get('/auth/google', 'AuthController@googleLogin');
$router->get('/auth/google/callback', 'AuthController@googleCallback');
$router->get('/auth/logout', 'AuthController@logout', 'AuthMiddleware');
$router->get('/', 'DashboardController@index', 'AuthMiddleware');

// Ferdi
$router->get('/tasks', 'TaskController@index', 'AuthMiddleware');
$router->post('/tasks/store', 'TaskController@store', 'AuthMiddleware');
$router->post('/tasks/update', 'TaskController@update', 'AuthMiddleware');
$router->post('/tasks/update-status', 'TaskController@updateStatus', 'AuthMiddleware');
$router->post('/tasks/delete', 'TaskController@delete', 'AuthMiddleware');

// Septiana
$router->get('/projects', 'ProjectController@index', 'AuthMiddleware');
$router->post('/project/store', 'ProjectController@store', 'AuthMiddleware');
$router->post('/project/update', 'ProjectController@update', 'AuthMiddleware');
$router->get('/projects/{id}', 'ProjectController@detail', 'AuthMiddleware');
$router->post('/project/delete', 'ProjectController@delete', 'AuthMiddleware');

// Eveleyn
$router->get('/calendar', 'CalendarController@index', 'AuthMiddleware');
$router->post('/calendar/store', 'CalendarController@store', 'AuthMiddleware');
$router->post('/calendar/update', 'CalendarController@update', 'AuthMiddleware');

// Nadifa
$router->get('/analytics', 'AnalyticController@index', 'AuthMiddleware');
$router->get('/settings', 'SettingController@index', 'AuthMiddleware');
$router->post('/settings/update', 'SettingController@update', 'AuthMiddleware');

$router->get('/notifications', 'NotificationController@getAll', 'AuthMiddleware');
$router->get('/notifications/count', 'NotificationController@unreadCount', 'AuthMiddleware');

$router->post('/notifications/read', 'NotificationController@markRead', 'AuthMiddleware');
$router->post('/notifications/read-all', 'NotificationController@markAllRead', 'AuthMiddleware');
$router->post('/notifications/delete', 'NotificationController@delete', 'AuthMiddleware');
$router->post('/notifications/deleteSelected', 'NotificationController@deleteSelected', 'AuthMiddleware');
$router->post('/notifications/clearAll', 'NotificationController@clearAll', 'AuthMiddleware');