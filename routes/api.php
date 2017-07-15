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
	Route::resource('/buku', 'BukuController');
	Route::resource('/kelas', 'KelasController');	
	Route::resource('/jurusan', 'JurusanController');	

	Route::resource('/provinsi', 'ProvinsiController');
	Route::resource('/kabkot', 'KabkotController');
	Route::resource('/kecamatan', 'KecamatanController');
	Route::resource('/kelurahan', 'KelurahanController');
});


//Guru
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Guru', 'prefix' => 'v1/guru'], function () {

	Route::resource('/isikelas', 'IsikelasController');
	Route::resource('/murid_kelas', 'MuridKelas');

	Route::resource('/pnilai', 'NilaipengaturanController');
	Route::resource('/muridkelas', 'MuridkelasController');

});

//Murid
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Murid', 'prefix' => 'v1/murid'], function () {

});

//Absen
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Absen', 'prefix' => 'v1/absen'], function () {

	Route::resource('/absen', 'AbsenController');
	Route::resource('/absenrekap', 'AbsenrekapController');
	Route::resource('/absentm', 'AbsentmController');
	Route::resource('/absentmt', 'AbsentmtController');
	Route::resource('/tabsen', 'TabsenController');
	
});

//Admin
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Admin', 'prefix' => 'v1/admin'], function () {

	Route::resource('/isikelas', 'IsikelasController');
	Route::resource('/muridkelas', 'MuridkelasController');
	Route::resource('/nilai', 'NilaiController');
	Route::resource('/murid', 'MuridController');
	Route::resource('/gurump', 'GurumpController');
	Route::resource('/guru', 'GuruController');	

});
