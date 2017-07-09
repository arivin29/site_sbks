<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Kabkot extends Model
{
  /**
   * Table database
   */
  protected $table = 't_kabkot';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'kabkot',
  ];

  public $timestamps = false;
  
  protected $primaryKey = 'id_kabkot';

  protected static function Insert($request)
  {
      $data = new Kabkot();
      $data->kabkot = $request->input('kabkot');

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
      $data = Kabkot::find($id);
      $data->kabkot = $request->input('kabkot');
        
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