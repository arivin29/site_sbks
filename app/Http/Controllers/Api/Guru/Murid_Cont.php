<?php

namespace App\Http\Controllers\Api\Guru;

use App\Http\Controllers\Controller;
use App\Models\Gurump;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;

class Murid_Cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function show($id_guru_mp)
    {   
         $data['murid'] = Gurump::getMuridByIdGuruMp($id_guru_mp);
         return $data;
    }

}
