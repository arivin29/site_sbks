<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Absenrekap extends Model
{
  /**
   * Table database
   */
  protected $table = 't_absen_rekap';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tanggal_rekap', 'tanggal_absen', 'masuk', 'keluar', 'lama_disekolah', 'telat', 'is_valid', 'id_murid', 'id_guru', 'report', 'id_user',
  ];

  protected $primaryKey = 'id_rekap_absen';

  protected static function Insert($request)
  {
      $data = new Absenrekap();
      $data->tanggal_rekap = $request->input('tanggal_rekap');
      $data->tanggal_absen = $request->input('tanggal_absen');
      $data->masuk = $request->input('masuk');
      $data->keluar = $request->input('keluar');
      $data->lama_disekolah = $request->input('lama_disekolah');
      $data->telat = $request->input('telat');
//    $data->is_valid = $request->input('is_valid');
      $data->id_murid = $request->input('id_murid');
      $data->id_guru = $request->input('id_guru');
      $data->report = $request->input('report');

      if($data->save())
      {
          return true;
      }
      else
      {
          return false;
      }
  }

  protected static function ubah(Request $request,$id)
  {
      $data = Absenrekap::find($id);
      $data->tanggal_rekap = $request->input('tanggal_rekap');
      $data->tanggal_absen = $request->input('tanggal_absen');
      $data->masuk = $request->input('masuk');
      $data->keluar = $request->input('keluar');
      $data->lama_disekolah = $request->input('lama_disekolah');
      $data->telat = $request->input('telat');
//    $data->is_valid = $request->input('is_valid');
      $data->id_murid = $request->input('id_murid');
      $data->id_guru = $request->input('id_guru');
      $data->report = $request->input('report');
      
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