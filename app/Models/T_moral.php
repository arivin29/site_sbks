<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model item ads
 */
class T_moral extends Model
{
  /**
   * Table database
   */
  protected $table = 't_moral';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */


  public $timestamps = false;
  protected $primaryKey = 'id_moral';

  
}