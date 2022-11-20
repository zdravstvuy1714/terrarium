<?php

/** @var Router $router */

use App\Http\Controllers\Authentication\Authentication\AuthenticateUser;
use App\Http\Controllers\Authentication\Registration\RegisterUser;
use Illuminate\Routing\Router;

// Authentication.
$router->group(['prefix' => 'authentication'], function (Router $router) {
    // Authentication.
    $router->post('authenticate', AuthenticateUser::class);

    // Registration.
    $router->post('register', RegisterUser::class);
});
