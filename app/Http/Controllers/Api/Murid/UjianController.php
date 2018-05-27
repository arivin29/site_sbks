<?php

namespace App\Http\Controllers\Api\Murid;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Muridkelas;
use App\Models\Ujian;
use App\Models\Ujian_jawaban;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class UjianController extends Controller {
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
                  max(m.mata_pelajaran) mata_pelajran,
                  max(j.jurusan) jurusan,
                  max(c.kelas) kelas,
                  max(c.kelas_paralel) kelas_paralel,
                  
                  max(CASE
                    WHEN a.tanggal_ujian_sampai < now() THEN
                      'default'
                    ELSE
                      'info'
                    END
                    ) warna
                FROM t_ujian a, t_ujian_soal b, t_guru_mp c, t_murid_kelas d , m_mata_pelajaran m, m_jurusan j
                WHERE a.id_ujian=b.id_ujian 
                and a.id_guru_mp = c.id_guru_mp 
                and c.id_jurusan = d.id_jurusan
                and c.kelas = d.kelas 
                and c.id_jurusan = j.id_jurusan 
                and c.kelas_paralel=d.kelas_paralel
                and c.id_mata_pelajaran=m.id_mata_pelajaran
                and a.smt=".Variable::getCurrentSmt()."
                and d.id_murid=".Query::getUser()->id_induk."
                group BY b.id_ujian ";

        $sql=" Select a.* from (".$sql.") a order by a.id_ujian DESC";
        $data['data'] = DB::select($sql);

        return $data;
    }

    public function show($id)
    {
        $data['ujian'] = Ujian::find($id);



        $data['murid'] = Ujian::find($id);
        return $data;

    }

    public function create(Request $request)
    {
        $sql=" Select * from t_ujian_jawaban where id_ujian=".$request->input('id_ujian')." and  id_murid=".Query::getUser()->id_induk." and validasi < 1";
        $cek = DB::select($sql);
        $a = 0;
        if(count($cek) < 1){
            $a=1;
            $cek = new Ujian_jawaban();
            $cek->id_ujian = $request->input('id_ujian');
            $cek->id_murid = Query::getUser()->id_induk;
            $cek->save();
        }
        $sql=" Select * from t_ujian_jawaban where id_ujian=".$request->input('id_ujian')." and  id_murid=".Query::getUser()->id_induk."  and validasi < 1";
        $cek_again = DB::select($sql);
        $data['jawaban'] = Ujian_jawaban::find($cek_again[0]->id_ujian_jawaban);

        if($a == 1){
            $soal = "
                insert into t_ujian_jawaban_soal (id_ujian_jawaban,id_ujian_soal)
              Select ".$data['jawaban']->id_ujian_jawaban." as id_ujian_jawaban, id_ujian_soal  from t_ujian_soal where id_ujian=".$request->input('id_ujian');
            DB::insert($soal);
        }
        $sql="select * from t_ujian_jawaban_soal WHERE id_ujian_jawaban=".$data['jawaban']->id_ujian_jawaban." order by urutan asc";
        $data['soal'] = DB::select($sql);

        $data['ujian'] = Ujian::find($request->input('id_ujian'));


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
        $data = Ujian_jawaban::find($request->input('id_ujian_jawaban'));
        if($request->input('mulai'))
        {
            $data->tanggal_ujuan = date("Y-m-d H:i:s");
        }

        $data->save();
    }


}
