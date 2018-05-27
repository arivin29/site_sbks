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

        $sql = "Select * from t_absen_kelas WHERE validasi=0 
                    and id_guru_mp=" . $request->input('id_guru_mp') . " ";

        $cek = DB::select($sql);

        if(count($cek) < 1)
        {
            $data = new AbsenKelas();
            $data->id_guru_mp =  $request->input('id_guru_mp');
            $data->save();
        }
        $absen = DB::select($sql)[0];

        $get_data_murid = Gurump::getMuridByIdGuruMp($request->input('id_guru_mp'));
        //Delete Sampah
        DB::delete("Delete from t_absen_kelas_detail WHERE id_absen_kelas= ".$absen->id_absen_kelas);

        //insert ka
        foreach ($get_data_murid as $x) {
            $data = new AbsenKelasDetail();
            $data->id_murid = $x->id_murid;
            $data->kehadiran = 1;
            $data->id_absen_kelas = $absen->id_absen_kelas;
            $data->smt = Variable::getCurrentSmt();
            $data->save();
        }

        $sql = "select a.*,b.nama_murid,b.nis 
            from t_absen_kelas_detail a, t_murid b
            WHERE a.id_murid = b.id_murid 
            and a.id_absen_kelas=".$absen->id_absen_kelas."  ";

        $data=[];
        $data['absen'] = $absen;
        $data['absen_murid'] = DB::select($sql);
        return $data;
    }

    protected static function saveAbsen($request, $id)
    {
        $absen = $request->input('absen_murid');
        $param = $request->input('absen');

        for ($a = 0; $a < count($absen); $a++) {

            $data = AbsenKelasDetail::find($absen[$a]['id_absen_kelas_detail']);
            $data->kehadiran = $absen[$a]['kehadiran'] > 3 ? 0 : $absen[$a]['kehadiran'];
            $data->alasan = isset($absen[$a]['alasan']) ? $absen[$a]['alasan'] :'';
            $data->save();
        }

        $absen = AbsenKelas::find($param['id_absen_kelas']);
        if(isset($param['tanggal_rekap']))
        {
            $absen->tanggal_rekap = $param['tanggal_rekap'];

        }
        else
        {
            $absen->tanggal_rekap = date('Y-m-d');
        }
        //hapus nan duplikat

        $sql=" delete from t_absen_kelas where id_guru_mp='".$param['id_guru_mp']."' and tanggal_rekap='".date('Y-m-d')."' and validasi=1";
        DB::delete($sql);

        $absen->validasi = 1;
        $absen->save();

        return true;
    }

    protected static function getByIdGuruMp($id_guru_mp)
    {
        $sql = "SELECT count(*),
                  max(a.id_guru_mp) as id_guru_mp,
                  max(a.id_absen_kelas) as id_absen_kelas,
                  max(a.tanggal_rekap) as tanggal_rekap,
                  sum( CASE when b.kehadiran =1 then 1 else 0 END ) as hadir,
                  sum( CASE when b.kehadiran in (0,2,3) then 1 else 0 END ) as alfa,
                  count(b.kehadiran) as total
                
                FROM t_absen_kelas a,
                  t_absen_kelas_detail b
                WHERE a.id_absen_kelas=b.id_absen_kelas
                and a.validasi > 0
                AND a.id_guru_mp=$id_guru_mp
                GROUP BY a.id_absen_kelas";
        return DB::select($sql);

    }

}