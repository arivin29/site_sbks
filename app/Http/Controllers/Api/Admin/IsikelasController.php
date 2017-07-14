<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use Illuminate\Support\Facades\Route;
use DB;

class IsikelasController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {   
        $sql = "select * from t_isi_kelas,m_kelas,m_jurusan,t_guru
                where t_isi_kelas.id_kelas=m_kelas.id_kelas
                and t_isi_kelas.id_jurusan=m_jurusan.id_jurusan
                and t_isi_kelas.id_guru_wali_kelas=t_guru.id_guru";
        $data =  DB::select($sql);
        return $data; 
    }

    public function create(Request $request)
    {
        $data ['kelas'] = Kelas::select('id_kelas','kelas')->get();
        $data ['jurusan'] = Jurusan::select('id_jurusan','jurusan')->get();
        $data ['guru'] = Guru::select('id_guru','nama_guru')->get();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Isikelas::Insert($request))
        {
            return response()->json(['status' => 'true', 'pesan' => 'Berhasil tambah data!'], 200);
        }
        return response()->json(['status' => 'false', 'pesan' => 'Gagal tambah data!'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $sql = "select * from t_murid_kelas,m_kelas,m_jurusan,t_guru,t_murid
                where t_murid_kelas.id_kelas=m_kelas.id_kelas
                and t_murid_kelas.id_jurusan=m_jurusan.id_jurusan
                and t_murid_kelas.id_guru_wali_kelas=t_guru.id_guru
                and t_murid_kelas.id_murid=t_murid.id_murid
                and t_murid_kelas.id_kelas=".$id;
        $data ['kelas'] =  DB::select($sql);

        $sql = "select * from t_nilai,t_murid,m_mata_pelajaran,m_kelas,t_guru
                where t_nilai.id_murid=t_murid.id_murid
                and t_nilai.id_mata_pelajaran=m_mata_pelajaran.id_mata_pelajaran
                and t_nilai.id_kelas=m_kelas.id_kelas
                and t_nilai.id_guru=t_guru.id_guru
                and t_nilai.id_kelas=".$id;
        $data ['nilai'] =  DB::select($sql);

        $sql = "select * from t_guru_mp,m_mata_pelajaran,t_guru,m_kelas 
                where t_guru_mp.id_mata_pelajaran=m_mata_pelajaran.id_mata_pelajaran 
                and t_guru_mp.id_guru=t_guru.id_guru
                and t_guru_mp.id_kelas=m_kelas.id_kelas 
                and t_guru_mp.id_kelas=".$id;
        $data ['gurump'] =  DB::select($sql);

        $sql= "select * from t_murid_kelas,t_murid,m_jurusan 
                where t_murid_kelas.id_murid=t_murid.id_murid 
                and t_murid_kelas.id_jurusan=m_jurusan.id_jurusan 
                and t_murid_kelas.id_jurusan=".$id;
        $data ['jurusan'] = DB::select($sql);

        return $data; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Isikelas::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Isikelas::ubah($request,$id))
        {
            return response()->json(['status' => 'false', 'pesan' => 'Berhasil ubah data!'],200);
        }

        return response()->json(['status' => 'false', 'pesan' => 'Gagal ubah data!'],400);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Isikelas::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
