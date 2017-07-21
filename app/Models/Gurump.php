<?php
namespace App\Models;
use App\Helper\Akses;
use App\Helper\Variable;
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
                  (b.mata_pelajaran || ' ' || b.kelas || ' ' || c.jurusan) as mata_pelajaran,
                  a.kelas_paralel,
                  a.jam_ngajar,
                  a.tahun_ajar
                
                
                FROM t_guru_mp a,
                  m_mata_pelajaran b,
                  m_jurusan c
                
                  WHERE a.id_mata_pelajaran=b.id_mata_pelajaran
                    and a.id_jurusan=c.id_jurusan
                    and a.tahun_ajar='".Variable::getTahunAjar()."'
                    --and a.id_guru=".Akses::getGuru()->id."
                     order by b.mata_pelajaran,a.kelas ASC
            ";
      $data =  DB::select($sql);
      return $data;
  }
    protected static function getById($id)
    {
        $sql = "SELECT
                  a.id_guru_mp,
                  a.kelas,
                  a.id_guru,
                  c.jurusan,
                  (b.mata_pelajaran || ' ' || b.kelas || ' ' || c.jurusan) as mata_pelajaran,
                  a.kelas_paralel,
                  a.jam_ngajar,
                  a.tahun_ajar
                
                
                FROM t_guru_mp a,
                  m_mata_pelajaran b,
                  m_jurusan c
                
                  WHERE a.id_mata_pelajaran=b.id_mata_pelajaran
                    and a.id_jurusan=c.id_jurusan
                    and a.tahun_ajar='".Variable::getTahunAjar()."'
                    --and a.id_guru=".Akses::getGuru()->id."
                    and a.id_guru_mp=$id
            ";
        $data =  DB::select($sql)[0];
        return $data;
    }

  protected static function getByguru($request)
  {
      $sql = "SELECT
                  *              
                
                FROM t_guru_mp a,
                  m_mata_pelajaran b,
                  m_jurusan c
                
                  WHERE a.id_mata_pelajaran=b.id_mata_pelajaran
                    and a.id_jurusan=c.id_jurusan
                    and a.id_guru=".$request->input('id_guru')." 
            ";
      $data =  DB::select($sql);
      return $data;
  }

  protected static function getMuridByIdGuruMp($id)
  {
      $sql = "SELECT
              a.id_murid,
              b.id_mata_pelajaran,
              b.kelas_paralel,
              b.kelas,
              b.id_guru_mp,
              b.id_jurusan,
              c.*
            from t_murid_kelas a,
              t_guru_mp b,
              t_murid c
            WHERE a.kelas=b.kelas
            and a.id_jurusan=b.id_jurusan
            and a.kelas_paralel=b.kelas_paralel 
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
      $sql=" Select * from t_guru_mp 
              where id_guru = '".$request->input('id_guru')."'
                and id_mata_pelajaran = '".$request->input('id_mata_pelajaran')."'
                and kelas = '".$request->input('kelas')."' 
                and kelas_paralel = '".$request->input('kelas_paralel')."'
                and id_jurusan = '".$request->input('id_jurusan')."'
              ";
      $cek = DB::select($sql);
      if(count($cek) > 0)
      {
          $data = Gurump::find($cek[0]->id_guru_mp);

      }
      else
      {
          $data = new Gurump();
      }
      $data->id_guru = $request->input('id_guru');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
      $data->jam_ngajar = $request->input('jam_ngajar');
      $data->jam_ngajar = $request->input('jam_ngajar');
      $data->kelas = $request->input('kelas');
      $data->kelas_paralel = $request->input('kelas_paralel');

      $data->save();
      return $data;

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