<?php

namespace App\Http\Controllers\Api\Ortu;

use App\Helper\Query;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Route;
use DB;
use select;

class MuridController extends Controller {

    public function index(Request $request)
    {
        $data = Murid::find(Query::getUser()->id_induk);
        return Response()->json($data);
    }

}
