<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Murid;
//use App\Models\Jenisnilai;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Support\Facades\Route;
use DB;

class Absen_cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $bulan =$request->input('bulan');
        $tahun = $request->input('tahun');

        $hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['hari'] = $hari;

        $tgl=" ";
        for ($a=1; $a <= $hari ; $a++)
        {
            $tgl.=" max(CASE WHEN (Extract(day from e.tanggal_rekap)=".$a.") then
                    1
                ELSE
                  0
              END) as h".$a;
            if($a < $hari)
            {
                $tgl.=",";
            }
        }

        $sql=" select * from (
                  SELECT
                      max(c.id_guru) id_guru,
                      max(c.nama_guru) nama_guru,
                      max(c.nip) nip,
                      max(b.mata_pelajaran) mata_pelajaran,
                      max(a.kelas) kelas,
                      max(d.jurusan) jurusan,
                      max(e.tanggal_rekap),
                      max(a.kelas_paralel) kelas_paralel,
                    
                      ".$tgl."
                    
                    
                    FROM t_guru_mp a,
                      m_mata_pelajaran b,
                      t_guru c,
                      m_jurusan d,
                      t_absen_kelas e
                    
                    WHERE a.id_mata_pelajaran=b.id_mata_pelajaran
                    and a.id_guru=c.id_guru
                    AND a.id_jurusan=d.id_jurusan
                    AND e.id_guru_mp=a.id_guru_mp
                    and extract(YEAR FROM e.tanggal_rekap) = ".$tahun."
                    and extract(MONTH FROM e.tanggal_rekap) = ".$bulan." 
                    GROUP BY a.id_guru_mp
                ) a order by a.nama_guru ASC ";

        $data['data'] = DB::select($sql);

        return view("laporan_absen",$data);

    }


}
