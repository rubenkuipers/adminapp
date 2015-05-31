<?php

// =============================================
// HOME PAGE ===================================
// =============================================
Route::get('/', function()
{
	return View::make('index');
});

// =============================================
// API ROUTES ==================================
// =============================================
Route::group(array('prefix' => 'api'), function() {

	// since we will be using this just for CRUD, we won't need create and edit
	// Angular will handle both of those forms
	// this ensures that a user can't access api/create or api/edit when there's nothing there
	Route::resource('clients', 'ClientController', 
		array('except' => array('create', 'edit')));

	Route::resource('invoices', 'InvoiceController', 
		array('except' => array('create', 'edit')));

	Route::resource('categories', 'CategoryController', 
		array('except' => array('create', 'edit')));

	Route::resource('tasklists', 'TasklistController', 
		array('except' => array('create', 'edit')));

	Route::resource('tasks', 'TaskController', 
		array('except' => array('create', 'edit')));

	Route::resource('projects', 'ProjectController', 
		array('except' => array('create', 'edit')));

	Route::resource('settings', 'SettingController', 
		array('except' => array('create', 'edit')));
});

// =============================================
// CATCH ALL ROUTE =============================
// =============================================
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them
App::missing(function($exception)
{
	return View::make('index');
});