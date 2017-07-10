<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Provinsi extends Model
{
  /**
   * Table database
   */
  protected $table = 't_provinsi';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'provinsi',
  ];

  public $timestamps = false;
  
  protected $primaryKey = 'id_provinsi';

  protected static function Insert($request)
  {
      $data = new Provinsi();
      $data->provinsi = $request->input('provinsi');

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
      $data = Provinsi::find($id);
      $data->provinsi = $request->input('provinsi');
        
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