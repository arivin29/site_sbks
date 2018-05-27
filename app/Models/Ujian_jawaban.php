<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Ujian_jawaban extends Model
{
    /**
     * Table database
     */
    protected $table = 't_ujian_jawaban';
    protected $primaryKey = 'id_ujian_jawaban';


    public $incrementing = false;


}