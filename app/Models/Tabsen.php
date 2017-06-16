<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Tabsen extends Model
{
  /**
   * Table database
   */
  protected $table = 't_absen';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_murid', 'tanggal_absen', 'type_absen', 'tanggal_upload', 'catatan',
  ];

  protected $primaryKey = 'id_absen';

  protected static function ubah(Request $request,$id)
  {
        $data = Tabsen::find($id);
        $data->id_murid = $request->input('id_murid');
        $data->tanggal_absen = $request->input('tanggal_absen');
        $data->type_absen = $request->input('type_absen');
        $data->tanggal_upload = $request->input('tanggal_upload');
        $data->catatan = $request->input('catatan');
        
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