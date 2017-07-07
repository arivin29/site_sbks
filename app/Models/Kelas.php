<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Kelas extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_kelas';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'kelas',
  ];
  
  public $timestamps = false;
  protected $primaryKey = 'id_kelas';

  protected static function Insert($request)
  {
      $data = new Kelas();
      $data->kelas = $request->input('kelas');

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
      $data = Kelas::find($id);
      $data->kelas = $request->input('kelas');
        
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