<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Ujian extends Model
{
    /**
     * Table database
     */
    protected $table = 't_ujian';
    protected $primaryKey = 'id_ujian';


    public $timestamps = false;
    public $incrementing = false;


}