<?php

namespace App\Http\Controllers\Api\Murid;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Muridkelas;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class KelasController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data['kelas'] = Muridkelas::getByMurid(Query::getUser()->id_induk);
        return $data;
    }


}
