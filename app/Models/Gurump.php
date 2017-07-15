<?php
namespace App\Models;
use App\Helper\Akses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Gurump extends Model
{
  /**
   * Table database
   */
  protected $table = 't_guru_mp';

  protected $primaryKey = 'id_guru_mp';

  protected static function getAll($request)
  {
      $sql = "SELECT
                  a.id_guru_mp,
                  a.kelas,
                  a.id_guru,
                  c.jurusan,
                  b.mata_pelajaran,
                  a.kelas_paralel 
                
                
                FROM t_guru_mp a,
                  m_mata_pelajaran b,
                  m_jurusan c
                
                  WHERE a.id_mata_pelajaran=b.id_mata_pelajaran
                    and a.id_jurusan=c.id_jurusan
                    and a.id_guru=".Akses::getGuru()->id." 
            ";
      $data =  DB::select($sql);
      return $data;
  }
  protected static function getMuridByIdGuruMp($id)
  {
      $sql = "SELECT
              a.id_murid,
              c.*
            from t_murid_kelas a,
              t_guru_mp b,
              t_murid c
            WHERE a.kelas=b.kelas
            and a.id_jurusan=b.id_jurusan
            and a.kelas_paralel=b.kelas_paralel
            and a.id_mata_pelajaran=b.id_mata_pelajaran
              and a.id_murid=c.id_murid
            and b.id_guru_mp=".$id." 
            ";
      $data =  DB::select($sql);
      return $data;
  }


  protected static function getNilaiByIdGuruMp($id)
  {
      $sql = "SELECT
              a.id_murid,
              c.*
            from t_murid_kelas a,
              t_guru_mp b,
              t_murid c
            WHERE a.kelas=b.kelas
            and a.id_jurusan=b.id_jurusan
            and a.kelas_paralel=b.kelas_paralel
            and a.id_mata_pelajaran=b.id_mata_pelajaran
              and a.id_murid=c.id_murid
            and b.id_guru_mp=".$id." 
            ";
      $data =  DB::select($sql);
      return $data;
  }


  protected static function Insert($request)
  {
      $data = new Gurump();
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->id_guru = $request->input('id_guru');
      $data->jam_ngajar = $request->input('jam_ngajar');
      $data->hari = $request->input('hari');
      $data->id_kelas = $request->input('id_kelas');

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
      $data = Gurump::find($id);
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->id_guru = $request->input('id_guru');
      $data->jam_ngajar = $request->input('jam_ngajar');
      $data->id_kelas = $request->input('id_kelas');
        
        
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