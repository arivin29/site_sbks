<?php

namespace App\Http\Controllers\Api\Acl;

use App\Helper\Variable;
use App\Helpers\Variabel;
use App\Models\M_Site;
use App\Models\Users\App_rule;
use App\Models\M_Ata;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Users_cont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['level'] = Variable::getLeveluser();
        $data['data'] = User::getAll($request);
        $data['status'] = [(object)['value'=>1,'param' => 'Active'],(object)['value'=>2,'param' => 'Non Active']];
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['site'] = M_Site::all();
        $data['level_user'] = DB::select('Select * from app_menu');

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
        $data = User::tambah($request);
        if($data)
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
        $data = User::getById($id)[0];
        return json_encode($data);
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
        $data = User::ubah($request,$id);
        if($data->save())
        {
            return response()->json(['status'=>'ok','data'=>$data ],200);
        }
        return response()->json(['status'=>'gagal simpan, data tidak valid'],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = M_Ata::find($id);
        if($data != null)
        {
            $data->is_deleted = 1;
            $data->save();
            return response()->json(['status'=>'ok'],200);
        }
        return response()->json(['status'=>'gagal hapus, data tidak ditemukan'],404);
    }
}
