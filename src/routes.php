<?php
use PaulVL\MagicAdmin\MagicAdmin;

Route::group(array('prefix' => MagicAdmin::$routeBase), function(){

	Route::get('/{model}', array(
		'as' => 'magic.all',
		'uses' => 'PaulVL\MagicAdmin\MagicController@all'
	));

	Route::get('/{model}/create', array(
		'as' => 'magic.create',
		'uses' => 'PaulVL\MagicAdmin\MagicController@create'
	));

	Route::post('/{model}/new', array(
		'as' => 'magic.store',
		'uses' => 'PaulVL\MagicAdmin\MagicController@store'
	));

	Route::get('/', array(
		'as' => 'magic.index',
		'uses' => 'PaulVL\MagicAdmin\MagicController@index'
	));

});

Route::group(array('prefix' => 'magic-test'), function(){
	Route::get('/', function(){
		return MagicAdmin::$routeBase;
	});
});



