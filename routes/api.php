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
	Route::resource('/gurump', 'GurumpController');
	
});

//Murid
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Murid', 'prefix' => 'v1/murid'], function () {

	Route::resource('/murid', 'MuridController');
	Route::resource('/muridkelas', 'MuridkelasController');
	Route::resource('/kelas', 'KelasController');	
	Route::resource('/jurusan', 'JurusanController');
	Route::resource('/nilai', 'NilaiController');

});

//Nilai
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Nilai', 'prefix' => 'v1/master'], function () {

	Route::resource('/pnilai', 'NilaipengaturanController');
	
});

//Indonesia
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Wilayah', 'prefix' => 'v1/wilayah'], function () {

	Route::resource('/provinsi', 'ProvinsiController');
	Route::resource('/kabkot', 'KabkotController');
	Route::resource('/kecamatan', 'KecamatanController');
	Route::resource('/kelurahan', 'KelurahanController');
	
});
