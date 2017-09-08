<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Guru extends Model
{
  /**
   * Table database
   */
  protected $table = 't_guru';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */


  protected $primaryKey = 'id_guru';

  protected static function Insert($request)
  {
      $data = new Guru();
      $data->nip = $request->input('nip');
      $data->nuptk = $request->input('nuptk');
      $data->nama_guru = $request->input('nama_guru');
      $data->nik_ktp = $request->input('nik_ktp');
      $data->tempat_lahir = $request->input('tempat_lahir');
      $data->tanggal_lahir = $request->input('tanggal_lahir');
      $data->jenis_kelamin = $request->input('jenis_kelamin');
      $data->nama_ibu = $request->input('nama_ibu');
      $data->status_pegawai = $request->input('status_pegawai');
      $data->golongan = $request->input('golongan');
      $data->tmk_sk_cpns = $request->input('tmk_sk_cpns');
      $data->tmk_sk_awal = $request->input('tmk_sk_awal');
      $data->tmk_sk_berakhir = $request->input('tmk_sk_berakhir');
      $data->alamat = $request->input('alamat');
      $data->id_provinsi = $request->input('id_provinsi');
      $data->id_kabkot = $request->input('id_kabkot');
      $data->id_kec = $request->input('id_kec');
//      $data->id_kelurahan = $request->input('id_kelurahan');
      $data->no_hp = $request->input('no_hp');
      $data->agama = $request->input('agama');
      $data->kode_pos = $request->input('kode_pos');
      $data->status_guru = $request->input('status_guru');

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
      $data = Guru::find($id);
      $data->nip = $request->input('nip');
      $data->nuptk = $request->input('nuptk');
      $data->nama_guru = $request->input('nama_guru');
      $data->nik_ktp = $request->input('nik_ktp');
      $data->tempat_lahir = $request->input('tempat_lahir');
      $data->tanggal_lahir = $request->input('tanggal_lahir');
      $data->jenis_kelamin = $request->input('jenis_kelamin');
      $data->nama_ibu = $request->input('nama_ibu');
      $data->status_pegawai = $request->input('status_pegawai');
      $data->golongan = $request->input('golongan');
      $data->tmk_sk_cpns = $request->input('tmk_sk_cpns');
      $data->tmk_sk_awal = $request->input('tmk_sk_awal');
      $data->tmk_sk_berakhir = $request->input('tmk_sk_berakhir');
      $data->alamat = $request->input('alamat');
      $data->id_provinsi = $request->input('id_provinsi');
      $data->id_kabkot = $request->input('id_kabkot');
      $data->id_kec = $request->input('id_kec');
//      $data->id_kelurahan = $request->input('id_kelurahan');
      $data->no_hp = $request->input('no_hp');
      $data->agama = $request->input('agama');
      $data->kode_pos = $request->input('kode_pos');
      $data->status_guru = $request->input('status_guru');
      
      if($data->update())
      {
          return true;
      }
      else
      {
          return false;
      }
  }

  protected static function getAll($request)
  {
      $sql= " Select a.*,
                  b.email as email_login
                from t_guru a,
                  users b
                WHERE a.id_guru=b.id_induk
                  and  a.id_guru > 0
                and b.tipe='guru' ";


      $param = $request->input();
      if(isset($param['nip']))
      {
          $sql.=" and a.nip like '%".$param['nip']."%'";
      }

      if(isset($param['nama_guru']))
      {
          $sql.=" and a.nama_guru like '%".$param['nama_guru']."%'";
      }

      if(isset($param['status_guru']))
      {
          $sql.=" and a.status_guru = '".$param['status_guru']."'";
      }

      $sql.=" Order by a.nama_guru ASC";
      return DB::select($sql);

  }

}