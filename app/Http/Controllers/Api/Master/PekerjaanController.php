<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Route;

class PekerjaanController extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index()
    {
        $data = Pekerjaan::paginate(10);
        return Response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Pekerjaan;
        $success = Pekerjaan::create($request->all());

        if(!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal tambah data!'], 400);
        } else {
            return Response()->json(['status' => 'true', 'pesan' => 'Berhasil tambah data!'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pekerjaan::find($id);
        if (is_null($data)) {
            return Response()->json(['status' => 'false', 'pesan' => 'Tidak ada data ditemukan!'], 400);
        }

        return Response()->json($data, 200);
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
        if(Pekerjaan::ubah($request,$id))
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
        $data = Pekerjaan::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
