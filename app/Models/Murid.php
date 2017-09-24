<?php
namespace App\Models;

use App\Helper\Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Murid extends Model
{
    /**
     * Table database
     */
    protected $table = 't_murid';

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
        $data->id_kabkot = $request->input('id_kabkot');
        $data->id_kec = $request->input('id_kec');
//      $data->id_kelurahan = $request->input('id_kelurahan');
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

        if ($data->save()) {
            return true;
        } else {
            return false;
        }
    }

    protected static function ubah(Request $request, $id)
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
        $data->id_kabkot = $request->input('id_kabkot');
        $data->id_kec = $request->input('id_kec');
//      $data->id_kelurahan = $request->input('id_kelurahan');
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

        if ($data->update()) {
            return true;
        } else {
            return false;
        }
    }

    protected static function getAll($request)
    {
        $sql = " Select * from t_murid WHERE id_murid > 0 ";


        $param = $request->input();
        if (isset($param['nis'])) {
            $sql .= " and nis like '%" . $param['nis'] . "%'";
        }

        if (isset($param['nama_murid'])) {
            $sql .= " and nama_murid like '%" . $param['nama_murid'] . "%'";
        }

        if (isset($param['status_murid'])) {
            $sql .= " and status_murid = '" . $param['status_murid'] . "'";
        }
        else
        {
            $sql .= " and status_murid = 'ON'";
        }

        $sql.= " Order by nama_murid ASC";

        $data = Query::pagination($sql,$request->input('page'));
        return $data;
    }

    protected static function getById($id)
    {
        $sql = "SELECT
                  a.*,
                  ibu.pekerjaan as pekerjaan_ibu,
                  bapak.pekerjaan as pekerjaan_bapak
                FROM t_murid a 
                left join m_pekerjaan bapak on a.id_pekerjaan_ayah=bapak.id_pekerjaan
                LEFT join m_pekerjaan ibu on a.id_pekerjaan_ibu=ibu.id_pekerjaan 
                WHERE   a.id_murid=".$id;

        return DB::select($sql)[0];
    }

    protected static function getMataPelajaran($id)
    {
        $sql = "SELECT
                  (a.mata_pelajaran || ' ' || a.kelas || ' ' || x.jurusan) as mata_pelajaran,
                  a.id_mata_pelajaran,
                  b.id_guru_mp,
                  c.*,
                  d.nama_guru
                FROM m_mata_pelajaran a,
                  m_jurusan x,
                t_guru_mp b,
                  (
                    SELECT
                    count(*),
                    max(x.smt) as smt,
                    max(x.id_murid) as id_murid,
                    max(x.kelas) as kelas,
                    max(x.id_jurusan) as id_jurusan,
                    max(y.jurusan) as jurusan,
                    max(x.no_absen) as no_absen,
                    max(x.status_murid) as status_murid_kelas,
                    max(x.tanggal_berlaku) as tanggal_berlaku,
                
                    max(x.updated_at) as updated_at,
                    max(x.id_wali_kelas) as id_wali_kelas,
                    max(x.kelas_paralel) as kelas_paralel
                  FROM t_murid_kelas x,
                    m_jurusan y
                    WHERE x.id_jurusan=y.id_jurusan
                  GROUP BY id_murid
                
                    ) c,
                  t_guru d
                
                WHERE a.id_mata_pelajaran=b.id_mata_pelajaran
                  and a.id_jurusan=x.id_jurusan
                  and b.id_guru=d.id_guru
                and b.id_jurusan=c.id_jurusan
                and b.kelas=c.kelas
                and b.kelas_paralel=c.kelas_paralel
                and c.id_murid=".$id;

        return DB::select($sql);
    }

    protected static function getNilaiMataPelajaran($id_murid, $id_mata_pelajaran)
    {
        $sql = "SELECT a.*,
                  b.*,
                  c.persentase,
                  c.if_remedial,
                  c.batas_remedial
                
                FROM t_nilai a,
                  m_jenis_nilai b
                  LEFT JOIN t_nilai_pengaturan c on (c.id_jenis_nilai=b.id_jenis_nilai)
                WHERE a.id_jenis_nilai=b.id_jenis_nilai
                    and a.id_murid=".$id_murid."
                    and a.id_mata_pelajaran=".$id_mata_pelajaran;

        return DB::select($sql);
    }

}