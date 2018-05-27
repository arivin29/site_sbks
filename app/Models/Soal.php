<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Soal extends Model
{
    /**
     * Table database
     */
    protected $table = 't_soal';
    protected $primaryKey = 'id_soal';


    public $timestamps = false;
    public $incrementing = false;


}