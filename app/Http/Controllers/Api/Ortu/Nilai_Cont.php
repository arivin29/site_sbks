<?php

namespace App\Http\Controllers\Api\Guru;

use App\Http\Controllers\Controller;
use App\Models\Gurump;
use App\Models\Jenisnilai;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Isikelas;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use DB;

class  Nilai_Cont extends Controller
{
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $id = $request->input('id_guru_mp');
        $get_murid = Gurump::getMuridByIdGuruMp($id);

        $murids = [];
        foreach ($get_murid as $x) {

            $get_nilai = Nilai::getByIdGuruMp($x->id_guru_mp,$x->id_murid);
            $nilais = [];
            foreach ($get_nilai as $y)
            {
                $nilais[] = $y;
            }
            $x->nilai = $nilais;
            $murids[] = $x;

        }
        $data['nilais'] = $murids;

        return $data;
    }

    public function create(Request $request)
    {
        $data ['jenis_nilai'] = Jenisnilai::all();
        $data['murid_nilai'] = Nilai::preeAdd($request);
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
        $data['nilai'] = Nilai::preeEdit($id);
        return json_encode($data,JSON_NUMERIC_CHECK);
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
        if($request->input('type')=='update')
        {
            Nilai::UpdatedNilai($request);

            return response()->json(['status' => 'false', 'pesan' => 'Berhasil ubah data!'], 200);
        }

        if ( $request->input('nilai')) {
            Nilai::saveNilai($request, $id);
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
