<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class T_Informarsi extends Model
{
  /**
   * Table database
   */
  protected $table = 't_informasi';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */


  public $timestamps = false;
  protected $primaryKey = 'id_informasi';

  
}