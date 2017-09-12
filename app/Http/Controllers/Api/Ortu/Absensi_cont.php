<?php

namespace App\Http\Controllers\Api\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenKelas;
use App\Models\Gurump;
use App\Models\Jenisnilai;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;

class  Absensi_cont extends Controller
{
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if($request->input('rekap'))
        {
            $id = $request->input('id_guru_mp');
            $get_murid = Gurump::getMuridByIdGuruMp($id);

            $murids = [];
            $total = 0;
            foreach ($get_murid as $x) {

                $get_nilai = AbsenKelas::getByIdGuruMp($x->id_guru_mp,$x->id_murid);
                $absens = [];
                foreach ($get_nilai as $y)
                {
                    $absens[] = $y;
                }
                $total = count($absens);
                $x->absen = $absens;
                $murids[] = $x;

            }
            $data['total'] = $total;
            $data['absensis'] = $murids;
        }
        else
        {
            $id = $request->input('id_guru_mp');
            $data['absensis'] = AbsenKelas::getByIdGuruMp($id);

        }

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
        if (AbsenKelas::saveAbsen($request, $id)) {
            return response()->json(['status' => 'false', 'pesan' => 'Berhasil ubah data!'], 200);
        }

        return response()->json(['status' => 'false', 'pesan' => 'Gagal ubah data!'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Isikelas::find($id);

        $success = $data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
