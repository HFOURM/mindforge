<?php

$router->get('/', 'DashboardController@index');

$router->get('/tasks', 'TaskController@index');

$router->get('/projects', 'ProjectController@index');

$router->get('/settings', 'SettingController@index');

$router->get('/calendar', 'CalendarController@index');

$router->get('/analytics', 'AnalyticController@index');