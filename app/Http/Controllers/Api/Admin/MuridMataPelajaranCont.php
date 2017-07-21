<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helper\Variable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muridkelas;
use App\Models\Murid;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Support\Facades\Route;
use DB;
use phpDocumentor\Reflection\Types\Object_;

class MuridMataPelajaranCont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {   
        $data['murid_mp'] = Murid::getMataPelajaran($request->input('id_murid'));

        $murid_mps = [];
        foreach ($data['murid_mp'] as $x)
        {
            $get_nilai = Murid::getNilaiMataPelajaran($x->id_murid,$x->id_mata_pelajaran);
            $nilais = [];
            foreach ($get_nilai as $y)
            {
                $nilais[] = $y;
            }
            $x->nilai = $nilais;
            $murid_mps[] = $x;

        }

        $data['murid_mp'] = $murid_mps;

        return $data;

    }


}
