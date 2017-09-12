<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    'mata_pelajaran', 'id_jurusan', 'id_kelas', 'status_mata_pelajaran'
  ];

  public $timestamps = false;
  protected $primaryKey = 'id_mata_pelajaran';

  protected static function Insert($request)
  {
      $data = new Mapel();
      $data->mata_pelajaran = $request->input('mata_pelajaran');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->kelas = $request->input('kelas');
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
      $data->id_jurusan = $request->input('id_jurusan');
      $data->kelas = $request->input('kelas');
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
  protected static function getAll()
  {
      $sql= "Select * from m_mata_pelajaran a,
              m_jurusan b 
              WHERE a.id_jurusan=b.id_jurusan";

      return DB::select($sql);
   }

}