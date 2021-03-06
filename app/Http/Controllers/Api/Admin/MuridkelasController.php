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

class MuridkelasController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {   
        $data['data'] = Muridkelas::getAll($request);
        $data['param'] = $request->input();

        $data['kelas'] = Variable::kelas();
        $data['paralel'] = Variable::paralel();
        $data['jurusan'] = Jurusan::all();
        $data['smt'] = Variable::smt_out();
        $data['config_smt'] = Variable::getSemester();

        return $data;
    }

    public function create()
    {
        $data ['guru'] = Guru::all();
        $data ['jurusan'] = Jurusan::all();
        $data ['kelas'] = Variable::kelas();
        $data ['paralel'] = Variable::paralel();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Muridkelas::Insert($request))
        {
            return response()->json(['status' => 'true', 'pesan' => 'Berhasil tambah data!'], 200);
        }
        return response()->json(['status' => 'false', 'pesan' => 'Gagal tambah data!'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['kelas'] = Muridkelas::getByMurid($id);
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
        return Muridkelas::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Muridkelas::ubah($request,$id))
        {
            return response()->json(['status' => 'false', 'pesan' => 'Berhasil ubah data!'],200);
        }

        return response()->json(['status' => 'false', 'pesan' => 'Gagal ubah data!'],400);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Muridkelas::find($id);
        if ($data->is_loacked == 0) {
            $data->delete();
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
