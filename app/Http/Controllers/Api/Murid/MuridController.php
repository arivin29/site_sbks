<?php

namespace App\Http\Controllers\Api\Murid;

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
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $data = Murid::where("nama_murid", "LIKE", "%{$request->get('search')}%")
                ->paginate(10);      
        }else{
          $data = Murid::paginate(10);
        }
        return response($data);
    }

    public function create()
    {
        $data ['pendidikan'] = Pendidikan::select('id_pendidikan','pendidikan')->get();
        $data ['pekerjaan'] = Pekerjaan::select('id_pekerjaan','pekerjaan')->get();

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
        if(Murid::Insert($request))
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
        $data = Murid::find($id);
        return Response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Murid::find($id);
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
        if(Murid::ubah($request,$id))
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
        $data = Murid::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
