<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use App\Models\Provinsi;
use App\Models\Kabkot;
use App\Models\Kecamatan;
//use App\Models\Kelurahan;
use Illuminate\Support\Facades\Route;
use DB;

class MuridController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {

        $data['murid'] = Murid::getAll($request);

        return $data;
    }

    public function create()
    {
        $data ['pendidikan'] = Pendidikan::select('id_pendidikan','pendidikan')->get();
        $data ['pekerjaan'] = Pekerjaan::select('id_pekerjaan','pekerjaan')->get();
        $data ['provinsi'] = Provinsi::select('id_provinsi','provinsi')->get();
        $data ['kabkot'] = Kabkot::select('id_kabkot','kabkot')->get();
        $data ['kecamatan'] = Kecamatan::select('id_kec','kecamatan')->get();  
//        $data ['kelurahan'] = Kelurahan::select('id_kelurahan','kelurahan')->get();

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
        if(Murid::Insert($request))
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
        $data['murid'] = Murid::getById($id);
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
        return Murid::find($id);
        $data ['pendidikan'] = Pendidikan::find($id);
        $data ['pekerjaan'] = Pekerjaan::find($id);
        $data ['provinsi'] = Provinsi::find($id);
        $data ['kabkot'] = Kabkot::find($id);
//        $data ['kelurahan'] = Kelurahan::find($id);
        $data ['kecamatan'] = Kecamatan::find($id);
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
        if(Murid::ubah($request,$id))
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
        $data = Murid::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
