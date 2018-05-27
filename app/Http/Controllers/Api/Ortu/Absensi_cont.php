<?php

namespace App\Http\Controllers\Api\Ortu;

use App\Helper\Query;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenKelas;
use App\Models\Gurump;
use App\Models\Jenisnilai;
use App\Models\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;

class  Absensi_cont extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Murid::find(Query::getUser()->id_induk);

        $sql= " SELECT
                  b.*,
                  a.db_date,
                  a.day_name
                FROM time_dimension a
                LEFT JOIN (SELECT
                min(scan_date) absen,
                count(pin) total,
                date_format(scan_date,\"%Y-%m-%d\") tgl
                FROM att_log
                WHERE pin= '".str_replace('.','',$data->nis)."'
                GROUP BY day(scan_date), month(scan_date),year(scan_date)
                LIMIT 50
                ) b on a.db_date=date(tgl)
                WHERE  date(a.db_date) between date(DATE_ADD(NOW(),INTERVAL -1 MONTH)) and DATE(NOW())
                order by a.db_date DESC
                limit 50";

        $data->ortu_absen = DB::connection('mysql')->select($sql);
        return $data;
    }


}
