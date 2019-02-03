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

$router->get('/', function () use ($router) {
	echo "TrackKnowledge Player API";
});

$router->get('players',  ['middleware'=>'auth', 'uses' => 'PlayerController@all']);
$router->get('players/{id}', ['middleware'=>'auth', 'uses' => 'PlayerController@get']);
$router->post('players', ['middleware'=>'auth', 'uses' => 'PlayerController@create']);
$router->delete('players/{id}', ['middleware'=>'auth', 'uses' => 'PlayerController@delete']);
$router->put('players/{id}', ['middleware'=>'auth', 'uses' => 'PlayerController@update']);
