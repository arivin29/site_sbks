<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Muridkelas extends Model
{
    /**
     * Table database
     */
    protected $table = 't_murid_kelas';


    protected $primaryKey = 'id_murid_kelas';

    protected static function Insert($request)
    {
        $sql="Select * from t_murid_kelas a 
              WHERE id_murid='".$request->input('id_murid')."'
              and id_jurusan='".$request->input('id_jurusan')."'
              and kelas='".$request->input('kelas')."'
              and smt='".$request->input('smt')."'
              and id_wali_kelas='".$request->input('id_wali_kelas')."'
              ";

        $cek = DB::select($sql);
        if(count($cek) > 0)
        {
            $data = Muridkelas::find($cek[0]->id_murid_kelas);
        }
        else
        {
            $data = new Muridkelas();
        }

        $data->id_murid = $request->input('id_murid');
        $data->id_jurusan = $request->input('id_jurusan');
        $data->kelas_paralel = $request->input('kelas_paralel');
        $data->kelas = $request->input('kelas');
        $data->no_absen = $request->input('no_absen');
        $data->status_murid = $request->input('status_murid');
        $data->tanggal_berlaku = $request->input('tanggal_berlaku');
        $data->smt = $request->input('smt');
        $data->id_wali_kelas = $request->input('id_wali_kelas');

        $data->save();
        return $data;
    }

    protected static function ubah(Request $request, $id)
    {
        $data = Muridkelas::find($id);
        $data->id_murid = $request->input('id_murid');
        $data->id_jurusan = $request->input('id_jurusan');
        $data->id_kelas = $request->input('id_kelas');
        $data->no_absen = $request->input('no_absen');
        $data->status_murid = $request->input('status_murid');
        $data->tanggal_berlaku = $request->input('tanggal_berlaku');
//    $data->id_user = $request->input('id_user');
        $data->smt = $request->input('smt');
        $data->id_guru_wali_kelas = $request->input('id_guru_wali_kelas');

        if ($data->update()) {
            return true;
        } else {
            return false;
        }
    }

    protected static function getAll($request)
    {
        $sql = "SELECT
                  a.nama_murid,
                  a.id_murid,
                  a.nis,
                  a.nisn,
                  a.no_hp,
                  mod(b.smt,2) as smt_out,
                  b.*
                from t_murid a
                LEFT JOIN (
                    SELECT
                      count(*),
                      max(x.smt) as smt,
                      max(x.id_murid) as id_murid_2,
                      max(x.kelas) as kelas,
                      max(x.id_jurusan) as id_jurusan,
                      max(y.jurusan) as jurusan,
                      max(x.no_absen) as no_absen,
                      max(x.status_murid) as status_murid_kelas,
                      max(x.tanggal_berlaku) as tanggal_berlaku,
                
                      max(x.updated_at) as updated_at,
                      max(x.id_wali_kelas) as id_wali_kelas,
                      max(x.kelas_paralel) as kelas_paralel
                    FROM t_murid_kelas x,
                      m_jurusan y
                      WHERE x.id_jurusan=y.id_jurusan
                    GROUP BY id_murid
                
                    ) b on a.id_murid=b.id_murid_2
                WHERE a.id_murid > 0 
                
                 ";


        $param = $request->input();
        if (isset($param['nis'])) {
            $sql .= " and nis like '%" . $param['nis'] . "%'";
        }

        if (isset($param['nama_murid'])) {
            $sql .= " and nama_murid like '%" . $param['nama_murid'] . "%'";
        }

        if (isset($param['status_murid'])) {
            $sql .= " and status_murid = '" . $param['status_murid'] . "'";
        } else {
            $sql .= " and status_murid = 'ON'";
        }

        if (isset($param['kelas_paralel'])) {
            $sql .= " and kelas_paralel = '" . $param['kelas_paralel'] . "'";
        }
        if (isset($param['id_jurusan'])) {
            $sql .= " and id_jurusan = '" . $param['id_jurusan'] . "'";
        }
        if (isset($param['kelas'])) {
            $sql .= " and kelas = '" . $param['kelas'] . "'";
        }
        if (isset($param['smt'])) {
            $sql .= " and mod(b.smt,2) = '" . $param['smt'] . "'";
        }

        $sql .= " Order by nama_murid ASC";
        return DB::select($sql);
    }

    protected static function getByMurid($id)
    {
        $sql = "SELECT a.*,
                  b.jurusan,
                  c.nama_guru
                FROM t_murid_kelas a,
                  m_jurusan b,
                  t_guru c
                WHERE a.id_jurusan=b.id_jurusan
                and a.id_wali_kelas=c.id_guru
                and a.id_murid=".$id." 
                order by a.kelas,smt ASC";

        return DB::select($sql);
    }

}