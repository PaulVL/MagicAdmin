<?php namespace PaulVL\MagicAdmin;

return array(

	'enabled' => true,

	/*
	|--------------------------------------------------------------------------
	| Default Skeletor Model Recovery Mode
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for all database work. Of course
	| you may use many connections at once using the Database library.
	|
	*/

	'default' => 'only',

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'modes' => array(

		'only' => array(
			array(
				'model_name' => 'UserType',
				'friendly_name' => 'Tipos de Usuario',
				'single_name' => 'Tipo de Usuario'
			),
			array(
				'model_name' => 'User',
				'friendly_name' => 'Usuarios',
				'single_name' => 'Usuario'
			)
		),

		'except' => array(
		),
	),

	'title' => '',

	'navbar_brand' => '',

);