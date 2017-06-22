<?php

namespace App\Http\Controllers\Api\Absen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tabsen;
use App\Models\Murid;
use Illuminate\Support\Facades\Route;
use DB;
use select;

class TabsenController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {
        $sql = DB::table('t_absen')
            ->join('t_murid', 't_absen.id_murid', '=', 't_murid.id_murid')
            ->select('t_absen.*', 't_murid.nama_murid')->paginate(10);

        return $sql;
    }

    public function create()
    {
        $data ['murid'] = Murid::select('id_murid','nama_murid')->get();

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
        if(Tabsen::Insert($request))
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
        $data = Tabsen::find($id);
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
        return Tabsen::find($id);
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
        if(Tabsen::ubah($request,$id))
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
        $data = Tabsen::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
