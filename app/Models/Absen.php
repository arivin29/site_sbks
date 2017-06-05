<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Absen extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_absen';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_murid', 'jam_masuk', 'jam_keluar', 'lama_disekolah', 'toleransi_telat', 'max_cuti', 'max_izin',
  ];

  protected $primaryKey = 'id_m_absen';

  protected static function ubah(Request $request,$id)
    {
        $data = Absen::find($id);
        $data->id_murid = $request->input('id_murid');
        $data->jam_masuk = $request->input('jam_masuk');
        $data->jam_keluar = $request->input('jam_keluar');
        $data->lama_disekolah = $request->input('lama_disekolah');
        $data->toleransi_telat = $request->input('toleransi_telat');
        $data->max_cuti = $request->input('max_cuti');
        $data->max_izin = $request->input('max_izin');
        
        if($data->update())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}