<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Gurumk extends Model
{
  /**
   * Table database
   */
  protected $table = 't_guru_mk';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_mata_pelajaran', 'id_guru', 'jam_ngajar',
  ];

  protected $primaryKey = 'id_guru_mk';

  protected static function ubah(Request $request,$id)
    {
        $data = Gurumk::find($id);
        $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
        $data->id_guru = $request->input('id_guru');
        $data->jam_ngajar = $request->input('jam_ngajar');
        
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