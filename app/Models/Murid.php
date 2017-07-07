<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Murid extends Model
{
  /**
   * Table database
   */
  protected $table = 't_murid';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'nis', 'nisn', 'nama_murid', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'hobi', 'cita_cita', 'jumlah_saudara', 'alamat', 'id_provinsi', 'provinsi', 'id_kabkot', 'kabkot', 'id_kec', 'kecamatan', 'kode_pos', 'no_kk', 'nama_ayah', 'id_pendidikan_ayah', 'id_pekerjaan_ayah', 'nama_ibu', 'id_pendidikan_ibu', 'id_pekerjaan_ibu', 'status_murid', 'agama',
  ];

  protected $primaryKey = 'id_murid';

  protected static function Insert($request)
  {
      $data = new Murid();
      $data->nis = $request->input('nis');
      $data->nisn = $request->input('nisn');
      $data->nama_murid = $request->input('nama_murid');
      $data->tempat_lahir = $request->input('tempat_lahir');
      $data->tanggal_lahir = $request->input('tanggal_lahir');
      $data->jenis_kelamin = $request->input('jenis_kelamin');
      $data->hobi = $request->input('hobi');
      $data->cita_cita = $request->input('cita_cita');
      $data->jumlah_saudara = $request->input('jumlah_saudara');
      $data->alamat = $request->input('alamat');
      $data->id_provinsi = $request->input('id_provinsi');
      $data->provinsi = $request->input('provinsi');
      $data->id_kabkot = $request->input('id_kabkot');
      $data->kabkot = $request->input('kabkot');
      $data->id_kec = $request->input('id_kec');
      $data->kecamatan = $request->input('kecamatan');
      $data->kode_pos = $request->input('kode_pos');
      $data->no_kk = $request->input('no_kk');
      $data->nama_ayah = $request->input('nama_ayah');
      $data->id_pendidikan_ayah = $request->input('id_pendidikan_ayah');
      $data->id_pekerjaan_ayah = $request->input('id_pekerjaan_ayah');
      $data->nama_ibu = $request->input('nama_ibu');
      $data->id_pendidikan_ibu = $request->input('id_pendidikan_ibu');
      $data->id_pekerjaan_ibu = $request->input('id_pekerjaan_ibu');
      $data->status_murid = $request->input('status_murid');
      $data->agama = $request->input('agama');

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
      $data = Murid::find($id);
      $data->nis = $request->input('nis');
      $data->nisn = $request->input('nisn');
      $data->nama_murid = $request->input('nama_murid');
      $data->tempat_lahir = $request->input('tempat_lahir');
      $data->tanggal_lahir = $request->input('tanggal_lahir');
      $data->jenis_kelamin = $request->input('jenis_kelamin');
      $data->hobi = $request->input('hobi');
      $data->cita_cita = $request->input('cita_cita');
      $data->jumlah_saudara = $request->input('jumlah_saudara');
      $data->alamat = $request->input('alamat');
      $data->id_provinsi = $request->input('id_provinsi');
      $data->provinsi = $request->input('provinsi');
      $data->id_kabkot = $request->input('id_kabkot');
      $data->kabkot = $request->input('kabkot');
      $data->id_kec = $request->input('id_kec');
      $data->kecamatan = $request->input('kecamatan');
      $data->kode_pos = $request->input('kode_pos');
      $data->no_kk = $request->input('no_kk');
      $data->nama_ayah = $request->input('nama_ayah');
      $data->id_pendidikan_ayah = $request->input('id_pendidikan_ayah');
      $data->id_pekerjaan_ayah = $request->input('id_pekerjaan_ayah');
      $data->nama_ibu = $request->input('nama_ibu');
      $data->id_pendidikan_ibu = $request->input('id_pendidikan_ibu');
      $data->id_pekerjaan_ibu = $request->input('id_pekerjaan_ibu');
      $data->status_murid = $request->input('status_murid');
      $data->agama = $request->input('agama');
        
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