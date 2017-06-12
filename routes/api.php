<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
date_default_timezone_get('Asia/Jakarta');

Route::group(['middleware' => ['api'], 'namespace'=>'Api\Master', 'prefix' => 'v1/master'], function () {

	Route::resource('/pendidikan', 'PendidikanController');
	Route::resource('/pekerjaan', 'PekerjaanController');
	Route::resource('/mapel', 'MapelController');
	Route::resource('/jn', 'JenisnilaiController');
	Route::resource('/absen', 'AbsenController');
	
});
