<?php

namespace App\Http\Controllers\Api\Guru\Elearning;

use App\Helper\Query;
use App\Helper\Variable;
use App\Http\Controllers\Controller;
use App\Models\Soal;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use select;

class Soal_cont extends Controller {
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $sql="SELECT a.id_mata_pelajaran,
                   ( (a.kelas) ||' - ' ||b.jurusan || ' - ' || a.mata_pelajaran) as mata_pelajaran
                from m_mata_pelajaran a ,
                  m_jurusan b
                WHERE a.id_jurusan=b.id_jurusan";

        $data['master_smt'] = Variable::smt_out();
        $data['master_mp'] = DB::select($sql);

        if($request->input('id_mata_pelajaran') and $request->input('smt'))
        {
            $sql=" 
                Select * 
                from  t_soal a
                WHERE a.id_guru=".Query::getUser()->id_induk."
                and a.id_mata_pelajaran = ".$request->input('id_mata_pelajaran')."
                and smt=".$request->input('smt')."
                order by id_soal ASC
                ";
            $data['soal'] = DB::select($sql);
        }

        return $data;
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('name_file');
        if($file != null)
        {
            $request->request->add(['name_file'=> date('Ymd').$file->getClientOriginalName()]);


            $pacth = public_path().'/soal/';
            if (!file_exists($pacth)) {
                mkdir($pacth, 0777, true);
            }
            $file->move($pacth,date('Ymd') .$file->getClientOriginalName());
        }

        $data = new Soal();
        $data->id_mata_pelajaran = $request->input('id_mata_pelajaran');
        if($file != null)
        {
            $data->foto = $request->input('name_file');
        }
        $data->id_guru = Query::getUser()->id_induk;
        $data->soal = $request->input('soal');
        $data->smt = $request->input('smt');
        $data->jawaban = $request->input('jawaban');
        $data->a = $request->input('a')== 'undefined' ? null : $request->input('a');
        $data->b = $request->input('b')== 'undefined' ? null : $request->input('b');
        $data->c = $request->input('c')== 'undefined' ? null : $request->input('c');
        $data->d = $request->input('d')== 'undefined' ? null : $request->input('d');
        $data->e = $request->input('e') == 'undefined' ? null : $request->input('e');
        if($data->save())
        {
            return response()->json(['status'=>'ok','data'=>$data ],200);
        }
        return response()->json(['status'=>'gagal simpan, data tidak valid'],404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        if(Buku::ubah($request,$id))
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
        $data = Buku::find($id);

        $success=$data->delete();

        if (!$success) {
            return Response()->json(['status' => 'false', 'pesan' => 'Gagal hapus data!'], 400);
        }

        return Response()->json(['status' => 'true', 'pesan' => 'Berhasil hapus data!'], 200);
    }
}
