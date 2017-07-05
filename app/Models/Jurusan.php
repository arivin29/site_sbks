<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Jurusan extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_jurusan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'jurusan',
  ];

  protected $primaryKey = 'id_jurusan';

  protected static function Insert($request)
  {
      $data = new Jurusan();
      $data->jurusan = $request->input('jurusan');

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
      $data = Jurusan::find($id);
      $data->jurusan = $request->input('jurusan');
        
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