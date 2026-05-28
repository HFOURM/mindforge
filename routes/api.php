<?php

$router->post('/api/auth/google', 'AuthController@googleCallback');

$router->get(
    '/api/user/profile',
    'UserController@profile',
    'JwtMiddleware'
);