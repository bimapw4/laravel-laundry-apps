<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Mail\MailForgotPassword;
use App\Services\Mail\MailManajer;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    "namespace" => "Auth",
    "prefix" => "auth"
], function () use ($router) {
    $router->post("/register", "AuthController@Register");
    $router->post("/login", "AuthController@Login");
    $router->post("/change-password", ["uses" => "AuthController@ChangePassword", "middleware" => "jwt.privateAuth"]);
    
    $router->group([
        "prefix" => "mail"
    ], function () use ($router) {
        $router->put('/forgot-password/{key}', "AuthController@ChangePassword");
        $router->get('/forgot-password/{key}', "AuthController@getMailforgotPassword");
        $router->post('/forgot-password', "AuthController@sendMailforgotPassword");
    });
});