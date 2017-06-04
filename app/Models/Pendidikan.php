<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Model item ads
 */
class Pendidikan extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_pendidikan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'pendidikan', 'level_pendidikan',
  ];

  protected $primaryKey = 'id_pendidikan';
}