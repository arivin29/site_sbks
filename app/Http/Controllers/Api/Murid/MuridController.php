<?php

namespace App\Http\Controllers\Api\Murid;

use App\Helper\Query;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class MuridController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $sql=" SELECT *
                FROM t_murid a
                
                WHERE a.id_murid = ".Query::getUser()->id_induk;
        $data['data'] = DB::select($sql)[0];
        return $data;
    }


}
