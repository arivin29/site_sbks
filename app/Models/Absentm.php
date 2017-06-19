<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Absentm extends Model
{
  /**
   * Table database
   */
  protected $table = 't_absen_tidak_masuk';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'type_tidak_masuk', 'tanggal_surat', 'id_murid', 'keterangan', 'nomor_surat', 'menyetujui', 'id_user',
  ];

  protected $primaryKey = 'id_tidak_masuk';

  protected static function Insert($request)
  {
      $data = new Absentm();
      $data->type_tidak_masuk = $request->input('type_tidak_masuk');
      $data->tanggal_surat = $request->input('tanggal_surat');
      $data->id_murid = $request->input('id_murid');
      $data->keterangan = $request->input('keterangan');
      $data->nomor_surat = $request->input('nomor_surat');
      $data->menyetujui = $request->input('menyetujui');

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
      $data = Absentm::find($id);
      $data->type_tidak_masuk = $request->input('type_tidak_masuk');
      $data->tanggal_surat = $request->input('tanggal_surat');
      $data->id_murid = $request->input('id_murid');
      $data->keterangan = $request->input('keterangan');
      $data->nomor_surat = $request->input('nomor_surat');
      $data->menyetujui = $request->input('menyetujui');
      
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