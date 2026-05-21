<?php

$router->post('/api/auth/google', 'AuthController@googleLogin');

$router->get(
    '/api/user/profile',
    'UserController@profile',
    'JwtMiddleware'
);