<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Nilai extends Model
{
    /**
     * Table database
     */
    protected $table = 't_nilai';


    protected $primaryKey = 'id_nilai';


    protected static function preeAdd($request)
    {
        $get_data_murid = Gurump::getMuridByIdGuruMp($request->input('id_guru_mp'));
        //Delete Sampah
        DB::delete("Delete from t_nilai WHERE validasi=0 and id_guru_mp=" . $request->input('id_guru_mp') . " ");

        foreach ($get_data_murid as $x) {
            $data = new Nilai();
            $data->id_murid = $x->id_murid;;
            $data->smt = Variable::getCurrentSmt();
            $data->id_mata_pelajaran = $x->id_mata_pelajaran;
            $data->id_guru_mp = $x->id_guru_mp;
            $data->kelas = $x->kelas;
            $data->kelas_paralel = $x->kelas_paralel;
            $data->id_jurusan = $x->id_jurusan;
            $data->save();
        }

        $sql = "select a.*,b.nama_murid,b.nis from t_nilai a, t_murid b
            WHERE a.id_murid = b.id_murid 
            and a.validasi=0 
            and a.id_guru_mp=" . $request->input('id_guru_mp') . " ";

        $data = DB::select($sql);
        return $data;
    }

    protected static function saveNilai($request, $id)
    {
        $nilai = $request->input('nilai');
        $param = $request->input('param');

        for ($a = 0; $a < count($nilai); $a++) {

            $data = Nilai::find($nilai[$a]['id_nilai']);
            $data->nilai = $nilai[$a]['nilai'] > 0 ? $nilai[$a]['nilai'] : $nilai[$a]['nilai_akhir'];
            $data->is_remedial = $nilai[$a]['is_remedial'];
            $data->id_jenis_nilai = $param['id_jenis_nilai'];
            $data->nilai_akhir = $nilai[$a]['nilai_akhir'];
            $data->batas_remedial = $param['batas_remedial'];
            $data->tanggal_rekap = $param['tanggal_rekap'];
            $data->validasi = 1;
            $data->save();
        }

        return true;
    }

    protected static function getByIdGuruMp($id_guru_mp,$id_murid)
    {
        $sql="SELECT
              c.jenis,
              a.nilai,
              a.nilai_akhir,
              a.id_jenis_nilai,
              a.is_remedial,
              a.batas_remedial,
              a.smt, 
              a.tanggal_rekap
            FROM t_nilai a,
              t_guru_mp b,
              m_jenis_nilai c
            
            WHERE a.id_guru_mp=b.id_guru_mp
            and c.id_jenis_nilai=a.id_jenis_nilai
            AND a.id_murid=$id_murid
            AND b.id_guru_mp=$id_guru_mp
            AND a.smt=".Variable::getCurrentSmt()."
            ORDER BY a.tanggal_rekap ASC";
        return DB::select($sql);

    }

}