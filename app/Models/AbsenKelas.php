<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class AbsenKelas extends Model
{
    /**
     * Table database
     */
    protected $table = 't_absen_kelas';


    protected $primaryKey = 'id_absen_kelas';


    protected static function preeAdd($request)
    {
        $get_data_murid = Gurump::getMuridByIdGuruMp($request->input('id_guru_mp'));
        //Delete Sampah
        DB::delete("Delete from t_absen_kelas WHERE validasi=0 and id_guru_mp=" . $request->input('id_guru_mp') . " ");

        foreach ($get_data_murid as $x) {
            $data = new AbsenKelas();
            $data->id_murid = $x->id_murid;
            $data->id_guru_mp = $x->id_guru_mp;
            $data->smt = Variable::getCurrentSmt();
            $data->validasi = 0;
            $data->save();
        }

        $sql = "select a.*,b.nama_murid,b.nis from t_absen_kelas a, t_murid b
            WHERE a.id_murid = b.id_murid 
            and a.validasi=0 
            and a.id_guru_mp=" . $request->input('id_guru_mp') . " ";

        $data = DB::select($sql);
        return $data;
    }

    protected static function saveAbsen($request, $id)
    {
        $absen = $request->input('absensi');
        $param = $request->input('param');

        for ($a = 0; $a < count($absen); $a++) {

            $data = AbsenKelas::find($absen[$a]['id_absen_kelas']);
            $data->tanggal_rekap = $param['tanggal_rekap'];
            $data->kehadiran = $absen[$a]['kehadiran'];
            $data->alasan = isset($absen[$a]['alasan']) ? $absen[$a]['alasan'] :'';
            $data->validasi = 1;
            $data->save();
        }

        return true;
    }

    protected static function getByIdGuruMp($id_guru_mp, $id_murid)
    {
        $sql = "SELECT
                  a.*
                FROM t_absen_kelas a,
                  t_guru_mp b
                
                WHERE a.id_guru_mp=b.id_guru_mp 
            AND a.id_murid=$id_murid
            AND b.id_guru_mp=$id_guru_mp
            AND a.smt=" . Variable::getCurrentSmt() . "
            ORDER BY a.tanggal_rekap ASC";
        return DB::select($sql);

    }

}