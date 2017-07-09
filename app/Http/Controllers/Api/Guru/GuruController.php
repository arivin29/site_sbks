<?php

namespace App\Http\Controllers\Api\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Provinsi;
use App\Models\Kabkot;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Route;
use DB;

class GuruController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if(strlen($request->input("nama_guru")) > 2){
           $data = Guru::where("nama_guru","like","%".$request->input('nama_guru')."%")->paginate(15);      
        }else{
          $data = Guru::paginate(15);
        }

        return $data;
    }

    public function create()
    {
        $data ['provinsi'] = Provinsi::select('id_provinsi','provinsi')->get();
        $data ['kabkot'] = Kabkot::select('id_kabkot','kabkot')->get();
        $data ['kecamatan'] = Kecamatan::select('id_kec','kecamatan')->get();
//        $data ['kelurahan'] = Kelurahan::select('id_kelurahan','kelurahan')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Guru::Insert($request))
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
        $data = Guru::find($id);
        $data ['provinsi'] = Provinsi::find($id);
        $data ['kabkot'] = Kabkot::find($id);
        $data ['kelurahan'] = Kelurahan::find($id);
        $data ['kecamatan'] = Kecamatan::find($id);

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
        return Guru::find($id);
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
        if(Guru::ubah($request,$id))
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
        $data = Guru::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
