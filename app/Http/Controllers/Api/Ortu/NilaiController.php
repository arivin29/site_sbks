<?php

namespace App\Http\Controllers\Api\Ortu;

use App\Helper\Query;
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
    public function index(Request $request)
    {
        $sql = "SELECT b.jenis,
                  a.nilai,
                  a.nilai_akhir,
                  a.batas_remedial,
                  a.is_remedial,
                  a.tanggal_rekap
                FROM t_nilai a,
                  m_jenis_nilai b
                WHERE a.id_jenis_nilai=b.id_jenis_nilai
                  and a.id_guru_mp=".$request->input('id_guru_mp')."
                and id_murid=".Query::getUser()->id_induk."
                ORDER BY a.id_nilai ASC";
        $data['nilais'] =  DB::select($sql);
        return $data;

    }


}
