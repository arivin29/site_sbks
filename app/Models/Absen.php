<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Model item ads
 */
class Absen extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_absen';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_murid', 'jam_masuk', 'jam_keluar', 'lama_disekolah', 'toleransi_telat', 'max_cuti', 'max_izin',
  ];

  protected $primaryKey = 'id_m_absen';
}