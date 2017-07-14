<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Isikelas extends Model
{
  /**
   * Table database
   */
  protected $table = 't_isi_kelas';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_kelas', 'id_jurusan', 'id_guru_wali_kelas'
  ];
  
  public $timestamps = false;
  protected $primaryKey = 'id_isi_kelas';

  protected static function Insert($request)
  {
      $data = new Isikelas();
      $data->id_kelas = $request->input('id_kelas');
      $data->id_jurusan = $request->input('id_jurusan');
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
      $data = Isikelas::find($id);
      $data->id_kelas = $request->input('id_kelas');
      $data->id_jurusan = $request->input('id_jurusan');
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