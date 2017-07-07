<?php
namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
/**
 * Model item ads
 */
class Pendidikan extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_pendidikan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'pendidikan', 'level_pendidikan'
  ];

  public $timestamps = false;
  protected $primaryKey = 'id_pendidikan';

  protected static function Insert($request)
  {
      $data = new Pendidikan();
      $data->pendidikan = $request->input('pendidikan');
      $data->level_pendidikan = $request->input('level_pendidikan');

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
      $data = Pendidikan::find($id);
      $data->pendidikan = $request->input('pendidikan');
      $data->level_pendidikan = $request->input('level_pendidikan');

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