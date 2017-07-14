<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Muridkelas extends Model
{
  /**
   * Table database
   */
  protected $table = 't_murid_kelas';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_murid', 'id_jurusan', 'id_kelas', 'no_absen', 'status_murid', 'tanggal_berlaku', 'id_user', 'smt', 'id_guru_wali_kelas',
  ];

  protected $primaryKey = 'id_murid_kelas';

  protected static function Insert($request)
  {
      $data = new Muridkelas();
      $data->id_murid = $request->input('id_murid');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->id_kelas = $request->input('id_kelas');
      $data->no_absen = $request->input('no_absen');
      $data->status_murid = $request->input('status_murid');
      $data->tanggal_berlaku = $request->input('tanggal_berlaku');
//    $data->id_user = $request->input('id_user');
      $data->smt = $request->input('smt');
      $data->id_guru_wali_kelas = $request->input('id_guru_wali_kelas');

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