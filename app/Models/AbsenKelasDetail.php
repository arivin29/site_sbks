<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class AbsenKelasDetail extends Model
{
    /**
     * Table database
     */
    protected $table = 't_absen_kelas_detail';
    protected $primaryKey = 'id_absen_kelas_detail';
    public $timestamps = false;

    protected static function getById($id)
    {
        $sql = "select a.*,b.nama_murid,b.nis 
            from t_absen_kelas_detail a, t_murid b
            WHERE a.id_murid = b.id_murid 
            and a.id_absen_kelas=".$id."  ";
        return DB::select($sql);
    }


}