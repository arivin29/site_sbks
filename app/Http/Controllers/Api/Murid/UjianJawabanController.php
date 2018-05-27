<?php

namespace App\Http\Controllers\Api\Murid;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Muridkelas;
use App\Models\Ujian_jawaban;
use App\Models\Ujian_jawaban_soal;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class UjianJawabanController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {

    }

    public function show($id)
    {
         $sql=" Select
               a.jawaban,
               a.id_ujian_jawaban_soal,
               c.soal,
               c.foto,
               c.a,
               c.b,
               c.c,
               c.d,
               c.e,
            
               a.urutan
             from t_ujian_jawaban_soal a ,
               t_ujian_soal b,
               t_soal c
             WHERE a.id_ujian_soal=b.id_ujian_soal
             and b.id_soal=c.id_soal
             AND a.id_ujian_jawaban_soal=".$id;

         $data =  DB::select($sql)[0];
         return json_encode($data);
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
        $data = Ujian_jawaban_soal::find($request->input('id_ujian_jawaban_soal'));
        $data->jawaban = $request->input('jawaban');

        $data->save();

        return $data;
    }


}
