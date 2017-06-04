<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Model item ads
 */
class Pekerjaan extends Model
{
  /**
   * Table database
   */
  protected $table = 'm_pekerjaan';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'pekerjaan',
  ];

  protected $primaryKey = 'id_pekerjaan';
}