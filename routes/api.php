<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['api'], 'namespace'=>'Api\Master', 'prefix' => 'v1/store'], function () {

	Route::resource('/pendidikan', 'PendidikanController');
	Route::resource('/pendidikan', 'PendidikanController');
	Route::resource('/pekerjaan', 'PekerjaanController');
	Route::resource('/mapel', 'MapelController');
	Route::resource('/jn', 'JenisnilaiController');
	Route::resource('/absen', 'AbsenController');
	
});
