<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Model item ads
 */
class Jenisnilai extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_jenis_nilai';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'jenis',
  ];

  protected $primaryKey = 'id_jenis_nilai';
}