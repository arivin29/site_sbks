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
    'nip', 'nuptk', 'nama', 'nik_ktp', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'nama_ibu', 'status_pegawai', 'golongan', 'tmk_sk_cpns', 'tmk_sk_awal', 'tmk_sk_berakhir', 'alamat', 'id_prov', 'provinsi', 'id_kabkot', 'kabkot', 'id_kec', 'kecamatan', 'id_kel', 'kelurahan', 'no_hp', 'agama', 'kode_pos', 'status_guru',
  ];

  protected $primaryKey = 'id_guru';

  protected static function ubah(Request $request,$id)
  {
        $data = Guru::find($id);
        $data->nip = $request->input('nip');
        $data->nuptk = $request->input('nuptk');
        $data->nama = $request->input('nama');
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
        $data->id_prov = $request->input('id_prov');
        $data->provinsi = $request->input('provinsi');
        $data->id_kabkot = $request->input('id_kabkot');
        $data->kabkot = $request->input('kabkot');
        $data->id_kec = $request->input('id_kec');
        $data->kecamatan = $request->input('kecamatan');
        $data->id_kel = $request->input('id_kel');
        $data->kelurahan = $request->input('kelurahan');
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