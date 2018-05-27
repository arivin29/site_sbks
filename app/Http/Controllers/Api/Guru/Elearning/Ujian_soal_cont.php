<?php

namespace App\Http\Controllers\Api\Guru\Elearning;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Gurump;
use App\Models\Ujian;
use App\Models\Ujian_soal;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class Ujian_soal_cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {

    }

    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sql=" Select * from t_ujian_soal where id_soal=".$request->input('id_soal')."  and id_ujian=".$request->input('id_ujian')."  ";
        $cek = DB::select($sql);
        if(count($cek) < 1){
            $cek = new Ujian_soal();
        }
        else
        {
            $cek = Ujian_soal::find($cek[0]->id_ujian_soal);
        }
        $cek-> id_soal = $request->input('id_soal');
        $cek-> id_ujian = $request->input('id_ujian');
        $cek->save();


        return $cek;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sql = "
            Select *
            from t_ujian_soal a,             
            t_soal b 
            WHERE a.id_soal=b.id_soal
            and a.id_ujian= ".$id."
        ";
        $data['soal'] =  DB::select($sql);
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
        if(Buku::ubah($request,$id))
        {
            return response()->json(['status' => 'false', 'pesan' => 'Berhasil ubah data!'],200);
        }

        return response()->json(['status' => 'false', 'pesan' => 'Gagal ubah data!'],400);
    }

    public function destroy($id)
    {
        $data = Ujian_soal::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
