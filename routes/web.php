<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use SebastianBergmann\Environment\Console;

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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/login', 'UserController@login');
    $router->post('/register', 'UserController@register');
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses' => 'MahasiswaController@show']);
    $router->get('/profile', ['middleware'=>'jwt.auth', 'uses' => 'MahasiswaController@getByToken']);
    $router->get('/{nim}', [ 'middleware'=>'jwt.auth','uses' => 'MahasiswaController@getUserById']);
    $router->put('/{nim}/matakuliah/{id}', ['uses'=> 'mahasiswaController@deleteMk']);
    // Mata Kuliah
    $router->post('{nim}/matakuliah/{id}', ['uses' => 'MahasiswaController@addMataKuliahtoMhs']); //

});

$router->group(['prefix' => 'matakuliah'], function () use ($router) {
    // Mata Kuliah
    $router->get('/', ['uses' => 'MataKuliahController@getAll']);
    $router->post('/add-mata-kuliah', ['uses' => 'MataKuliahController@addMataKuliah']);
    $router->get('/{id}', ['uses' => 'MataKuliahController@getMataKuliahById']);

});

