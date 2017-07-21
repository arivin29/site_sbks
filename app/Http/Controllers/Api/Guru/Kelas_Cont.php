<?php

namespace App\Http\Controllers\Api\Guru;

use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Gurump;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;

class Kelas_Cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {   
        $data['kelas'] = Gurump::getAll($request);
        $data['param'] = $request->input();
        return $data;
    }


    public function show($id)
    {   
         $data['kelas'] = Gurump::getById($id);
         $data['kelas']->smt = Variable::getCurrentSmt();
         $data['kelas']->tahun_ajar = Variable::getTahunAjar();
         return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Isikelas::find($id);
    }


}
