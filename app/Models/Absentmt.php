<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Absentmt extends Model
{
  /**
   * Table database
   */
  protected $table = 't_absen_tidak_masuk_tanggal';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tanggal_tidak_masuk',
  ];

  protected $primaryKey = 'id_tidak_masuk_tanggal';

  protected static function ubah(Request $request,$id)
  {
        $data = Absentmt::find($id);
        $data->tanggal_tidak_masuk = $request->input('tanggal_tidak_masuk');
        
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