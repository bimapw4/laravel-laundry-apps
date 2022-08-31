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

$router->group([
    "namespace" => "Category",
    "prefix" => "category",
    "middleware" => "jwt.privateAuth"
], function () use ($router) {
    $router->get('/', 'IndexController@Index');
    $router->post('/', 'IndexController@Create');
    $router->put('/', 'IndexController@Update');
    $router->delete('/{id}', 'IndexController@Delete');
});

$router->group([
    "namespace" => "pelanggan",
    "prefix" => "user",
    "middleware" => "jwt.privateAuth"
], function () use ($router) {
    $router->get("/", "IndexController@Index");
    $router->post("/", "IndexController@Create");
    $router->put("/", "IndexController@Update");
    $router->delete("/{id}", "IndexController@Delete");
});

$router->group([
    "namespace" => "Barang",
    "prefix" => "item",
    "middleware" => "jwt.privateAuth"
], function () use ($router) {
    $router->get("/", "IndexController@index");
    $router->post("/", "IndexController@create");
    $router->put("/", "IndexController@update");
    $router->delete("/{id}", "IndexController@delete");
});

$router->group([
    "namespace" => "Layanan",
    "prefix" => "services",
    "middleware" => "jwt.privateAuth"
], function () use ($router) {
    $router->get("/", "IndexController@index");
    $router->post("/", "IndexController@create");
    $router->put("/", "IndexController@update");
    $router->delete("/{id}", "IndexController@delete");
});