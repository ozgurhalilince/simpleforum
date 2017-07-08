<?php

/*
 *
 *
 *
 */


Route::group(['middleware' => 'web', 
			  'namespace' => 'Ozgurince\Simpleforum\Controllers', 
		 	  'prefix' => 'ozgurince/simpleforum'], function(){
	
	Route::get('/', 'CategoriesController@index')->name('homepage');
	
	// Resource Routes
	Route::resource('/categories', 'CategoriesController');	
	Route::resource('/questions', 'QuestionsController');
	Route::resource('/comments', 'CommentsController');
	Route::resource('/files', 'FilesController', ['only' => ['show']]);
	Route::resource('/users', 'UsersController');
	
	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Profile Routes
	Route::get('/profil/id={id}', 'ProfileController@profile_with_id')->name('profile_with_id');	
	Route::get('/profil/{username}', 'ProfileController@profile_with_username')->name('profile_with_username');

	// Settings Routes
	Route::get('/ayarlar', 'SettingsController@index')->name('settings');	
	Route::post('/update-password', 'SettingsController@updatePassword')->name('update-password');    
    Route::post('/update-general', 'SettingsController@updateGeneral')->name('update-general');
    Route::post('/update-username', 'SettingsController@updateUsername')->name('update-username');
    Route::post('/update-profile-photo', 'SettingsController@updateProfilePhoto')->name('update-profile-photo');	


	Route::post("/auth-user", function(){
		return Auth::user();
	});

	Route::get('/logout', function () {
	    Auth::logout();
	    return redirect()->route('homepage');
	})->name('logout');
});


