<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT');
header("Access-Control-Allow-Headers: Authorization, X-Requested-With,  Content-Type, Accept");

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

/*
 * For Api-Tester
 */
Route::group([
	'middleware' => 'api',
], function($router) {

    Route::get('announces/{domain}', '\App\Api\Controllers\AnnounceController@list');
    Route::get('taxoffices/{zone_id}', '\App\Api\Controllers\TaxOfficeController@list');
    Route::get('product/{id}', '\App\Api\Controllers\ProductController@detail');
    Route::get('zone/country', '\App\Api\Controllers\ZoneController@country');
    Route::get('zone/city/{id}', '\App\Api\Controllers\ZoneController@zone');
    Route::get('whm/detail/{domain}', '\App\Api\Controllers\WhmController@detail');
    Route::get('partnership/{id}', '\App\Api\Controllers\PartnershipController@index');
    Route::post('partnership/{id}', '\App\Api\Controllers\PartnershipController@store');

});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Api\Controllers'], function ($api) {

    $api->get('announces/{domain}', 'AnnounceController@list');
    $api->get('sliders', 'AnnounceSliderController@list');
    $api->get('taxoffices/{zone_id}', 'TaxOfficeController@list');
    $api->get('sectors', 'SectorController@list');
    $api->get('product/{id}', 'ProductController@detail');
    $api->get('zone/country', 'ZoneController@country');	
    $api->get('zone/city/{id}', 'ZoneController@zone');	
    $api->get('whm/detail/{domain}', 'WhmController@detail');

    $api->get('partnership/{id}', 'PartnershipController@index');
    $api->post('partnership/{id}', 'PartnershipController@store');

    $api->post('ecommercecontroller', 'EcommerceControllerController@store');
    $api->get('service/{id}', 'UserProductController@detail');

    $api->get('ticket/{user_id}', 'TicketController@list');
    $api->get('ticket/{user_id}/{ticket_id}', 'TicketController@detail');

});