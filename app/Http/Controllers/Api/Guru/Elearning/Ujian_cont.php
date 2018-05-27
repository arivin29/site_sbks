<?php

namespace App\Http\Controllers\Api\Guru\Elearning;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Gurump;
use App\Models\Ujian;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class Ujian_cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $sql = "SELECT
                  max(a.id_ujian) as id_ujian,
                  max(a.smt) smt,
                  max(a.tanggal_ujian) tanggal_ujian,
                  max(a.tanggal_ujian_sampai) tanggal_ujian_sampai,
                  max(a.waktu) waktu,
                  max(a.keterangan) keterangan,
                  max(a.judul) judul,
                  COUNT (b.id_soal) as soal,
                  
                  
                  max(CASE
                    WHEN a.tanggal_ujian_sampai < now() THEN
                      'default'
                    ELSE
                      'info'
                    END
                    ) warna
                FROM t_ujian a, t_ujian_soal b
                WHERE a.id_ujian=b.id_ujian
                and a.id_guru_mp=".$request->input('id_guru_mp')."
                and smt=".Variable::getCurrentSmt()."
                group BY b.id_ujian ";

        $sql=" Select a.* from (".$sql.") a order by a.id_ujian DESC";
        $data['data'] = DB::select($sql);

        return $data;
    }

    public function create(Request $request)
    {
        $sql=" Select * from t_ujian where id_guru_mp=".$request->input('id_guru_mp')." and is_puplish < 1";
        $cek = DB::select($sql);
        if(count($cek) < 1){
            $cek = new Ujian();
            $cek->id_guru_mp = $request->input('id_guru_mp');
            $cek->save();
        }
        $sql=" Select * from t_ujian where id_guru_mp=".$request->input('id_guru_mp')." and is_puplish < 1";
        $cek = DB::select($sql);

        $data['ujian'] = Ujian::find($cek[0]->id_ujian);

        $guru_mp = Gurump::find($request->input('id_guru_mp'));
        $sql="Select * from t_soal where id_mata_pelajaran = ".$guru_mp->id_mata_pelajaran." and smt=".Variable::getCurrentSmt();
        $data['pertanyaan'] = DB::select($sql);

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
        $data = Ujian::find($request->input('id_ujian'));
        $data->judul = $request->input('judul');
        $data->keterangan = $request->input('keterangan');
        $data->waktu = $request->input('waktu');
        $data->tanggal_ujian = $request->input('tanggal_ujian');
        $data->tanggal_ujian_sampai = $request->input('tanggal_ujian_sampai');
        $data->aturan = $request->input('aturan');
        $data->smt = Variable::getCurrentSmt();

        $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['ujian'] = Ujian::find($id);



        $data['murid'] = Ujian::find($id);
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
        return Buku::find($id);
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
        $data = Ujian::find($request->input('id_ujian'));
        $data->is_puplish = 1;
        $data->tanggal_ujian = $request->input('tanggal_ujian');
        $data->keterangan = $request->input('keterangan');
        $data->tanggal_ujian_sampai = $request->input('tanggal_ujian_sampai');
        if($data->save())
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
        $data = Buku::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
