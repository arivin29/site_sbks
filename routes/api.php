<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


//Master
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Master', 'prefix' => 'v1/master'], function () {

	Route::resource('/pendidikan', 'PendidikanController');
	Route::resource('/pekerjaan', 'PekerjaanController');
	Route::resource('/mapel', 'MapelController');
	Route::resource('/jn', 'JenisnilaiController');
	Route::resource('/absen', 'AbsenController');
	
});

//Absen
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Absen', 'prefix' => 'v1/master'], function () {

	Route::resource('/absenrekap', 'AbsenrekapController');
	Route::resource('/absentm', 'AbsentmController');
	Route::resource('/absentmt', 'AbsentmtController');
	Route::resource('/tabsen', 'TabsenController');
	
});

//Buku
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Buku', 'prefix' => 'v1/master'], function () {

	Route::resource('/buku', 'BukuController');
	
});

//Guru
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Guru', 'prefix' => 'v1/master'], function () {

	Route::resource('/guru', 'GuruController');
	Route::resource('/gurumk', 'GurumkController');
	
});

//Murid
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Murid', 'prefix' => 'v1/master'], function () {

	Route::resource('/murid', 'MuridController');
	Route::resource('/muridkelas', 'MuridkelasController');
	
});

//Nilai
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Nilai', 'prefix' => 'v1/master'], function () {

	Route::resource('/nilai', 'NilaiController');
	Route::resource('/pnilai', 'NilaipengaturanController');
	
});
