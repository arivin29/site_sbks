<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
date_default_timezone_set('Asia/Jakarta');

Route::auth();

Route::group(['middleware' => ['api'],'prefix' => 'v1'], function () {

    Route::get('dam_user', 'Api\AuthCont@getRole');
    Route::post('login', 'Api\AuthCont@authenticate');
    Route::post('online/login', 'Api\AuthCont@authenticateOnline');
    Route::get('refresh', 'Api\AuthCont@refresh');
    Route::get('user/me', 'Api\AuthCont@getAuthenticatedUser');

});


Route::group(['middleware' => ['jwt.auth'],'prefix' => 'v2'], function () {

    Route::get('/', function (Request $request)
    {
        return Auth::id();
    });

});

Route::group(['middleware' => ['web'],'namespace'=>'Api\Umum', 'prefix' => 'v1/umum'], function () {

    Route::resource('kalender','Kalender_Cont');
    Route::resource('extra','Extra_Cont');
    Route::resource('informasi','Informasi');

});
Route::group(['middleware' => ['web'],'namespace'=>'Api\Acl', 'prefix' => 'v1/acl'], function () {

    Route::resource('users','Users_cont');
    Route::resource('akses','Akses_cont');
    Route::resource('akses_android','Akses_android_cont');

});


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

	Route::resource('/kelas', 'Kelas_Cont');
	Route::resource('/murid', 'Murid_Cont');
	Route::resource('/nilai', 'Nilai_Cont');
	Route::resource('/absensi', 'Absensi_cont');
	Route::resource('/absensi_detail', 'Absensi_detail_cont');
	Route::resource('/moral', 'Moral_cont');


	Route::resource('/soal', 'Elearning\Soal_cont');
	Route::resource('/ujian', 'Elearning\Ujian_cont');
	Route::resource('/ujian_soal', 'Elearning\Ujian_soal_cont');

});

//Murid
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Murid', 'prefix' => 'v1/murid'], function () {

    Route::resource('/murid', 'MuridController');
    Route::resource('/kelas', 'KelasController');
    Route::resource('/ujian', 'UjianController');
    Route::resource('/ujian-jawaban', 'UjianJawabanController');

});

//Ortu
Route::group(['middleware' => ['api'], 'namespace'=>'Api\Ortu', 'prefix' => 'v1/ortu'], function () {
    Route::resource('/nilai', 'NilaiController');
    Route::resource('/mata_pelajaran', 'MataPelajaranController');
    Route::resource('/murid', 'MuridController');
    Route::resource('/absensi', 'Absensi_cont');
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
	Route::resource('/murid_kelas', 'MuridkelasController');
	Route::resource('/murid_mp', 'MuridMataPelajaranCont');
	Route::resource('/murid', 'MuridController');
	Route::resource('/gurump', 'GurumpController');
	Route::resource('/guru', 'GuruController');	
	Route::resource('/absen', 'Absen_cont');

});
