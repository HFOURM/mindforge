<?php

$router->post('/api/auth/google', 'AuthController@googleCallback');

$router->get(
    '/api/user/profile',
    'UserController@profile',
    'JwtMiddleware'
);

$router->post('/api/auth/login', 'AuthController@login');

// Tasks API Endpoints (RESTful)
$router->get('/api/tasks', 'TaskController@index', 'JwtMiddleware');
$router->get('/api/tasks/date/{date}', 'TaskController@getByDate', 'JwtMiddleware');
$router->post('/api/tasks', 'TaskController@store', 'JwtMiddleware');
$router->put('/api/tasks/{id}', 'TaskController@update', 'JwtMiddleware');
$router->delete('/api/tasks/{id}', 'TaskController@destroy', 'JwtMiddleware');

// Events API Endpoints
$router->get('/api/events/date/{date}', 'EventController@getByDate', 'JwtMiddleware');
