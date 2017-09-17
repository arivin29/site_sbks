<?php

namespace App\Http\Controllers\Api\Guru;

use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Gurump;
use App\Models\T_Informarsi;
use App\Models\T_moral;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;
use phpDocumentor\Reflection\Types\Object_;

class Moral_cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $sql="Select a.*, b.nama_murid, b.nis from t_moral a, t_murid b where a.id_murid=b.id_murid";
         $data['moral'] = DB::select($sql);
         return $data;
    }




}
