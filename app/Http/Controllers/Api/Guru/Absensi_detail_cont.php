<?php

namespace App\Http\Controllers\Api\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenKelas;
use App\Models\AbsenKelasDetail;
use App\Models\Gurump;
use App\Models\Jenisnilai;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;

class  Absensi_detail_cont extends Controller
{
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {

        $id = $request->input('id_absen_kelas');
        $data['absen_murid'] = AbsenKelasDetail::getById($id);
        return $data;
    }

    public function create(Request $request)
    {
        $data = AbsenKelas::preeAdd($request);
        return $data;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
