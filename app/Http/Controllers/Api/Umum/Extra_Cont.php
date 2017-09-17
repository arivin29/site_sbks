<?php

namespace App\Http\Controllers\Api\Umum;

use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Gurump;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;
use phpDocumentor\Reflection\Types\Object_;

class Extra_Cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data = [];


        for ($a =1; $a < 12;$a++)
        {
            $kalender = (Object)[];
            $kalender->nama = $a;
            $kalender->nama_file = url('/extra/'.$a.'.jpeg');
            $data[] = $kalender;
        }

        $data['extra'] = $data;
        return $data;
    }




}
