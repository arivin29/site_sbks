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

class Kalender_Cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data = [];
        $months = array(

            'July ',
            'August',
            'September',
            'October',
            'November',
            'December',
            'January',
            'February',
            'March',
            'April',
            'May',
            'June'
        );


        for ($a =1; $a < 13;$a++)
        {
            $kalender = (Object)[];
            $kalender->bulan = $months[($a-1)];
            $kalender->nama_file = url('/kalender/'.$a.'.png');
            $data[] = $kalender;
        }

        $data['kalender'] = $data;
        return $data;
    }




}
