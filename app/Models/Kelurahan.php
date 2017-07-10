<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Kelurahan extends Model
{
  /**
   * Table database
   */
  protected $table = 't_kelurahan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'kelurahan',
  ];

  public $timestamps = false;
  
  protected $primaryKey = 'id_kelurahan';

  protected static function Insert($request)
  {
      $data = new Kelurahan();
      $data->kelurahan = $request->input('kelurahan');

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
      $data = Kelurahan::find($id);
      $data->kelurahan = $request->input('kelurahan');
        
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