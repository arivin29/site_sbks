<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Nilai extends Model
{
  /**
   * Table database
   */
  protected $table = 't_nilai';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_guru_mp', 'id_jenis_nilai', 'id_murid', 'nilai', 'is_remedial', 'id_user', 'rumus', 'nilai_akhir','smt',
  ];

  protected $primaryKey = 'id_nilai';

  protected static function Insert($request)
  {
      $data = new Nilai();
      $data->id_guru_mp = $request->input('id_guru_mp');
      $data->id_jenis_nilai = $request->input('id_jenis_nilai');
      $data->id_murid = $request->input('id_murid');
      $data->nilai = $request->input('nilai');
      $data->is_remedial = $request->input('is_remedial');
//    $data->id_user = $request->input('id_user');
      $data->rumus = $request->input('rumus');
      $data->nilai_akhir = $request->input('nilai_akhir');
      $data->smt = $request->input('smt');

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
      $data = Nilai::find($id);
      $data->id_guru_mp = $request->input('id_guru_mp');
      $data->id_jenis_nilai = $request->input('id_jenis_nilai');
      $data->id_murid = $request->input('id_murid');
      $data->nilai = $request->input('nilai');
      $data->is_remedial = $request->input('is_remedial');
//    $data->id_user = $request->input('id_user');
      $data->rumus = $request->input('rumus');
      $data->nilai_akhir = $request->input('nilai_akhir');
      $data->smt = $request->input('smt');
      
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