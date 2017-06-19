<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Pekerjaan extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_pekerjaan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'pekerjaan',
  ];

  protected $primaryKey = 'id_pekerjaan';

  protected static function Insert($request)
  {
      $data = new Pekerjaan();
      $data->pekerjaan = $request->input('pekerjaan');

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
      $data = Pekerjaan::find($id);
      $data->pekerjaan = $request->input('pekerjaan');
        
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