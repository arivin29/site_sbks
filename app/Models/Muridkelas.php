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
    'id_murid', 'tingkat', 'id_jurusan', 'kelas_paralel', 'no_absen', 'id_status_murid', 'status_murid', 'tanggal_berlaku', 'id_user', 'id_guru_wali_kelas', 'guru_wali_kelas', 'smt', 'id_guru',
  ];

  protected $primaryKey = 'id_murid_kelas';

  protected static function Insert($request)
  {
      $data = new Muridkelas();
      $data->id_murid = $request->input('id_murid');
      $data->tingkat = $request->input('tingkat');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->kelas_paralel = $request->input('kelas_paralel');
      $data->no_absen = $request->input('no_absen');
      $data->id_status_murid = $request->input('id_status_murid');
      $data->status_murid = $request->input('status_murid');
      $data->tanggal_berlaku = $request->input('tanggal_berlaku');
//    $data->id_user = $request->input('id_user');
      $data->id_guru_wali_kelas = $request->input('id_guru_wali_kelas');
      $data->guru_wali_kelas = $request->input('guru_wali_kelas');
      $data->smt = $request->input('smt');
      $data->id_guru = $request->input('id_guru');

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
      $data->tingkat = $request->input('tingkat');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->kelas_paralel = $request->input('kelas_paralel');
      $data->no_absen = $request->input('no_absen');
      $data->id_status_murid = $request->input('id_status_murid');
      $data->status_murid = $request->input('status_murid');
      $data->tanggal_berlaku = $request->input('tanggal_berlaku');
//    $data->id_user = $request->input('id_user');
      $data->id_guru_wali_kelas = $request->input('id_guru_wali_kelas');
      $data->guru_wali_kelas = $request->input('guru_wali_kelas');
      $data->smt = $request->input('smt');
      $data->id_guru = $request->input('id_guru');
        
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