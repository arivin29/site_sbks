<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
  protected $fillable = [
    'nip', 'nuptk', 'nama_guru', 'nik_ktp', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'nama_ibu', 'status_pegawai', 'golongan', 'tmk_sk_cpns', 'tmk_sk_awal', 'tmk_sk_berakhir', 'alamat', 'id_provinsi', 'id_kabkot', 'id_kec', 'id_kelurahan', 'no_hp', 'agama', 'kode_pos', 'status_guru',
  ];

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

}