<?php
namespace App\Models;

use App\Helper\Variable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Model item ads
 */
class Ujian_jawaban_soal extends Model
{
    /**
     * Table database
     */
    protected $table = 't_ujian_jawaban_soal';
    protected $primaryKey = 'id_ujian_jawaban_soal';


    public $incrementing = false;
    public $timestamps = false;


}