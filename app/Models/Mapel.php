<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Mapel extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_mata_pelajaran';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'mata_pelajaran', 'tingkat', 'id_jurusan', 'jurusan', 'kelas_paralel', 'status_mata_pelajaran'
  ];

  protected $primaryKey = 'id_mata_pelajaran';

  protected static function Insert($request)
  {
      $data = new Mapel();
      $data->mata_pelajaran = $request->input('mata_pelajaran');
      $data->tingkat = $request->input('tingkat');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->jurusan = $request->input('jurusan');
      $data->kelas_paralel = $request->input('kelas_paralel');
      $data->status_mata_pelajaran = $request->input('status_mata_pelajaran');

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
      $data = Mapel::find($id);
      $data->mata_pelajaran = $request->input('mata_pelajaran');
      $data->tingkat = $request->input('tingkat');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->jurusan = $request->input('jurusan');
      $data->kelas_paralel = $request->input('kelas_paralel');
      $data->status_mata_pelajaran = $request->input('status_mata_pelajaran');
        
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