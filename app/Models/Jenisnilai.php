<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Jenisnilai extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_jenis_nilai';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'jenis',
  ];

  protected $primaryKey = 'id_jenis_nilai';

  protected static function ubah(Request $request,$id)
    {
        $data = Jenisnilai::find($id);
        $data->jenis = $request->input('jenis');
        
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