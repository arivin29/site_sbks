<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Route;
use DB;

class BukuController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {
        $sql = DB::table('t_buku')
            ->join('t_guru', 't_buku.id_guru', '=', 't_guru.id_guru')
            ->join('m_jurusan', 't_buku.id_jurusan', '=', 'm_jurusan.id_jurusan')
            ->join('m_kelas', 't_buku.id_kelas', '=', 'm_kelas.id_kelas')
            ->select('t_buku.*', 'm_jurusan.jurusan', 'm_kelas.kelas', 't_guru.nama_guru')->paginate(15);

        return $sql;
    }

    public function create()
    {
        $data ['guru'] = Guru::select('id_guru','nama_guru')->get();
        $data ['jurusan'] = Jurusan::select('id_jurusan','jurusan')->get();
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
        if(Buku::Insert($request))
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
        $data = Buku::find($id);
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
        if(Buku::ubah($request,$id))
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
