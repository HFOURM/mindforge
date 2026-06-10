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
$router->get('/api/tasks/{date}', 'TaskController@getByDate', 'JwtMiddleware');
$router->post('/api/tasks', 'TaskController@store', 'JwtMiddleware');
$router->put('/api/tasks/{id}', 'TaskController@update', 'JwtMiddleware');
$router->post('/api/tasks/{id}', 'TaskController@destroy', 'JwtMiddleware');

$router->put(
    '/api/tasks/{id}/status',
    'TaskController@updateStatus',
    'JwtMiddleware'
);



$router->get(
    '/api/projects',
    'ProjectController@index',
    'JwtMiddleware'
);

// Events API Endpoints
$router->get('/api/events/date/{date}', 'EventController@getByDate', 'JwtMiddleware');
