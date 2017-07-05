<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class Buku extends Model
{
  /**
   * Table database
   */
  protected $table = 't_buku';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tingkat', 'id_jurusan', 'kelas_paralel', 'id_guru', 'judul', 'keterangan', 'nama_file', 'keyword', 'lokasi_file'
  ];

  protected $primaryKey = 'id_buku';

  protected static function Insert($request)
  {
      $data = new Buku();
      $data->tingkat = $request->input('tingkat');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->kelas_paralel = $request->input('kelas_paralel');
      $data->id_guru = $request->input('id_guru');
      $data->judul = $request->input('judul');
      $data->keterangan = $request->input('keterangan');
      $data->nama_file = $request->input('nama_file');
      $data->keyword = $request->input('keyword');
      $data->lokasi_file = $request->input('lokasi_file');

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
      $data = Buku::find($id);
      $data->tingkat = $request->input('tingkat');
      $data->id_jurusan = $request->input('id_jurusan');
      $data->kelas_paralel = $request->input('kelas_paralel');
      $data->id_guru = $request->input('id_guru');
      $data->judul = $request->input('judul');
      $data->keterangan = $request->input('keterangan');
      $data->nama_file = $request->input('nama_file');
      $data->keyword = $request->input('keyword');
      $data->lokasi_file = $request->input('lokasi_file');
      
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