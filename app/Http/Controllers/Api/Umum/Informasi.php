<?php

namespace App\Http\Controllers\Api\Umum;

use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Gurump;
use App\Models\T_Informarsi;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;
use phpDocumentor\Reflection\Types\Object_;

class Informasi extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
         $data['informasi'] = T_Informarsi::all();
         return $data;
    }




}
