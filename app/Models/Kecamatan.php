<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Kecamatan extends Model
{
  /**
   * Table database
   */
  protected $table = 't_kecamatan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'kecamatan',
  ];

  public $timestamps = false;
  
  protected $primaryKey = 'id_kec';

  protected static function Insert($request)
  {
      $data = new Kecamatan();
      $data->kecamatan = $request->input('kecamatan');

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
      $data = Kecamatan::find($id);
      $data->kecamatan = $request->input('kecamatan');
        
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