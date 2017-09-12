<?php

namespace App\Http\Controllers\Api\Ortu;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Murid;
use App\Models\Jenisnilai;
use Illuminate\Support\Facades\Route;
use DB;
use select;

class MataPelajaranController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {
        $sql = "SELECT
          a.id_murid_kelas,
          d.mata_pelajaran,
          a.smt,
          c.id_guru_mp
        
        FROM t_murid_kelas a,
          (SELECT max(id_murid_kelas) id_murid_kelas from t_murid_kelas WHERE id_murid=".Query::getUser()->id_induk.") b,
          t_guru_mp c,
          m_mata_pelajaran d
        WHERE a.id_murid_kelas=b.id_murid_kelas
        and a.id_jurusan=c.id_jurusan
        and a.kelas=c.kelas
        and a.kelas_paralel=c.kelas_paralel
        and c.id_mata_pelajaran=d.id_mata_pelajaran
        and a.id_murid=".Query::getUser()->id_induk."
        and c.tahun_ajar='".Variable::getTahunAjar()."'";
        $data =  DB::select($sql);
        return $data;

    }


}
