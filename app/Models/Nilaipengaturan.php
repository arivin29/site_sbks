<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Nilaipengaturan extends Model
{
  /**
   * Table database
   */
  protected $table = 't_nilai_pengaturan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_guru_mp', 'kelas', 'batas_remedial', 'persentase', 'id_jenis_nilai', 'if_remedial',
  ];

  public $timestamps = false;
  protected $primaryKey = 'id_pengaturan_nilai';

  protected static function Insert($request)
  {
      $data = new Nilaipengaturan();
      $data->id_guru_mp = $request->input('id_guru_mp');
      $data->kelas = $request->input('kelas');
      $data->batas_remedial = $request->input('batas_remedial');
      $data->persentase = $request->input('persentase');
      $data->id_jenis_nilai = $request->input('id_jenis_nilai');
      $data->if_remedial = $request->input('if_remedial');

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
      $data = Nilaipengaturan::find($id);
      $data->id_guru_mp = $request->input('id_guru_mp');
      $data->kelas = $request->input('kelas');
      $data->batas_remedial = $request->input('batas_remedial');
      $data->persentase = $request->input('persentase');
      $data->id_jenis_nilai = $request->input('id_jenis_nilai');
      $data->if_remedial = $request->input('if_remedial');
      
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