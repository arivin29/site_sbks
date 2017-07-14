<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gurump;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Support\Facades\Route;
use DB;

class GurumpController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {   
        $sql = "select * from t_guru_mp,m_mata_pelajaran,t_guru,m_kelas
                where t_guru_mp.id_mata_pelajaran=m_mata_pelajaran.id_mata_pelajaran 
                and t_guru_mp.id_guru=t_guru.id_guru
                and t_guru_mp.id_kelas=m_kelas.id_kelas order by id_guru_mp desc";
        $data =  DB::select($sql);
        return $data;

    }

    public function create()
    {
        $data ['mapel'] = Mapel::select('id_mata_pelajaran','mata_pelajaran')->get();
        $data ['guru'] = Guru::select('id_guru','nama_guru')->get();
        $data ['kelas'] = Kelas::select('id_kelas','kelas')->get();
    
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
        if(Gurump::Insert($request))
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
        $data = Gurump::find($id);
        if (is_null($data)) {
            return Response()->json(['status' => 'false', 'pesan' => 'Tidak ada data ditemukan!'], 400);
        }

        return Response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Gurump::find($id);
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
        if(Gurump::ubah($request,$id))
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
        $data = Gurump::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
