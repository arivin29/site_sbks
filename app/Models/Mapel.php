<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Model item ads
 */
class Mapel extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_mata_pelajaran';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'mata_pelajaran', 'tingkat', 'id_jurusan', 'jurusan', 'kelas_paralel', 'status_mata_pelajaran'
  ];

  protected $primaryKey = 'id_mata_pelajaran';
}