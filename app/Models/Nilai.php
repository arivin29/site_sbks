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
    'id_jenis_nilai', 'id_murid', 'is_remedial', 'id_user', 'rumus', 'nilai_akhir','smt', 'id_mata_pelajaran', 'id_guru', 'id_kelas', 'nilai_satu', 'nilai_dua', 'nilai_uts', 'nilai_tiga', 'nilai_empat', 'nilai_uas',
  ];

  protected $primaryKey = 'id_nilai';

  protected static function Insert($request)
  {
      $data = new Nilai();
//      $data->id_jenis_nilai = $request->input('id_jenis_nilai');
      $data->id_murid = $request->input('id_murid');
      $data->is_remedial = $request->input('is_remedial');
//    $data->id_user = $request->input('id_user');
      $data->rumus = $request->input('rumus');
      $data->nilai_akhir = $request->input('nilai_akhir');
      $data->smt = $request->input('smt');
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->id_guru = $request->input('id_guru');
      $data->id_kelas = $request->input('id_kelas');
      $data->nilai_satu = $request->input('nilai_satu');
      $data->nilai_dua = $request->input('nilai_dua');
      $data->nilai_uts = $request->input('nilai_uts');
      $data->nilai_tiga = $request->input('nilai_tiga');
      $data->nilai_empat = $request->input('nilai_empat');
      $data->nilai_uas = $request->input('nilai_uas');

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
//      $data->id_jenis_nilai = $request->input('id_jenis_nilai');
      $data->id_murid = $request->input('id_murid');
      $data->is_remedial = $request->input('is_remedial');
//    $data->id_user = $request->input('id_user');
      $data->rumus = $request->input('rumus');
      $data->nilai_akhir = $request->input('nilai_akhir');
      $data->smt = $request->input('smt');
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->id_guru = $request->input('id_guru');
      $data->id_kelas = $request->input('id_kelas');
      $data->nilai_satu = $request->input('nilai_satu');
      $data->nilai_dua = $request->input('nilai_dua');
      $data->nilai_uts = $request->input('nilai_uts');
      $data->nilai_tiga = $request->input('nilai_tiga');
      $data->nilai_empat = $request->input('nilai_empat');
      $data->nilai_uas = $request->input('nilai_uas');
            
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