<?php

namespace App\Http\Controllers\Api\Nilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Murid;
use App\Models\Jenisnilai;
use Illuminate\Support\Facades\Route;
use DB;
use select;

class NilaiController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {
        $sql = "select * from t_nilai,t_murid,m_jenis_nilai where t_nilai.id_murid=t_murid.id_murid and t_nilai.id_jenis_nilai=m_jenis_nilai.id_jenis_nilai";
        $data =  DB::select($sql);
        return $data;

/*        $sql = DB::table('t_nilai')
            ->join('t_murid', 't_nilai.id_murid', '=', 't_murid.id_murid')
            ->join('m_jenis_nilai', 't_nilai.id_jenis_nilai', '=', 'm_jenis_nilai.id_jenis_nilai')
            ->select('t_nilai.*', 't_murid.nama_murid', 'm_jenis_nilai.jenis')->paginate(10);

        return $sql;
*/
    }

    public function create(Request $request)
    {
        $data ['murid'] = Murid::select('id_murid','nama_murid')->get();
        $data ['jn'] = Jenisnilai::select('id_jenis_nilai','jenis')->get();

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
        if(Nilai::Insert($request))
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
        $data = Nilai::find($id);
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
        return Nilai::find($id);
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
        if(Nilai::ubah($request,$id))
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
        $data = Nilai::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
