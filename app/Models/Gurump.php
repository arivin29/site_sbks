<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Gurump extends Model
{
  /**
   * Table database
   */
  protected $table = 't_guru_mp';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_mata_pelajaran', 'id_guru', 'jam_ngajar', 'hari', 'id_kelas',
  ];

  protected $primaryKey = 'id_guru_mp';

  protected static function Insert($request)
  {
      $data = new Gurump();
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->id_guru = $request->input('id_guru');
      $data->jam_ngajar = $request->input('jam_ngajar');
      $data->hari = $request->input('hari');
      $data->id_kelas = $request->input('id_kelas');

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
      $data = Gurump::find($id);
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->id_guru = $request->input('id_guru');
      $data->jam_ngajar = $request->input('jam_ngajar');
      $data->id_kelas = $request->input('id_kelas');
        
        
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