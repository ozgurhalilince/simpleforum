<?php

/*
 *
 *
 *
 */

Route::group(['middleware' => 'auth:api', 
			  'namespace' => 'Ozgurince\Simpleforum\Controllers', 
		 	  'prefix' => 'ozgurince/simpleforum/api'], function(){


	Route::post('like', 'LikesController@like');
	Route::post('unlike', 'LikesController@unlike');

});

// emre mor: ?api_token=4zQKHnpYsQwK8R8VRcpFWoA7MCzrjqjduB8FePb0Og1otDMIJ0OFoCFq6Hl0