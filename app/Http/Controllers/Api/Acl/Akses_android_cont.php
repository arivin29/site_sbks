<?php

namespace App\Http\Controllers\Api\Acl;

use App\Helper\Query;
use App\Models\Users\App_rule;
use App\Models\M_Ata;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Object_;

class Akses_android_cont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Query::getUser();
        $data->pwd = '';
        return $data;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //update password android
        return $request;
    }

//    public function index(Request $request)
//    {
//
//        $router = $request->input('router');
//        $tb =  "<table border='1'>";
////        dd($router[140]);
//        DB::delete("Delete from app_role where type_role='normal'");
//
//        for ($x=0; $x < count($router)  ;$x++)
//        {
//            $role = new App_rule();
//
//            $tb.=  "<tr>";
//
//                $tb.=  "<td>".$x."</td>";
//                if(isset($router[$x]->getaction()['as']))
//                {
//                    $as =  $router[$x]->getaction()['as'];
//
//                    $role->as_site = $as;
//
//                    $tb.=  "<td>".$as."</td>";
//                }
//                else
//                {
//                    $tb .= "<td>validation</td>";
//                    $role->as_site = 'validation';
//                }
//
//                $prefix = explode('/',$router[$x]->getaction()['prefix']);
//                $prefix = $prefix[count($prefix)-1];
//
//                $role->prefix = $prefix;
//                $tb.=  "<td>".$prefix."</td>";
//
//                if(isset($router[$x]->getaction()['controller']))
//                {
//                    $controller = $router[$x]->getaction()['controller'];
//                    $tb.=  "<td>".$controller."</td>";
//                }
//                else
//                {
//                    $tb .= "<td></td>";
//                }
//
//                $tb.=  "<td>".$router[$x]->geturi()."</td>";
//                $role->url = $router[$x]->geturi();
//
////                AS Client
//                if(isset($router[$x]->getaction()['as']))
//                {
//                    $as =  $router[$x]->getaction()['as'];
//                    $as =  str_replace('.index','',$as);
//                    $as =  str_replace('show','detail',$as);
//
//                    $as_client = $prefix.".".$as;
//                    $tb.=  "<td>".$as_client."</td>";
//
//                    $role->as_client = $as_client;
//                }
//                else
//                {
//                    $tb .= "<td></td>";
//                }
//
//
//            $tb.=  "</tr>";
//
//            $role->save();
//            $role = null;
//        }
//
//        $tb.=  "</table>";
//        //echo  $tb;
//        //return $tb;
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = User::find($request->input('id'));
        $data->password = Hash::make($request->input('pwd'));
        if($data->save())
        {
            return response()->json($data,200);
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
        $sql = "SELECT *
                        FROM (
                          SELECT
                            max(a.ID_USER) as id_user,
                            max(b.ID_ROLE) as ID_ROLE,
                            max(b.PREFIX) as PREFIX,
                            max(b.URL) as URL,
                            max(b.AS_CLIENT) as AS_CLIENT,
                            max(b.AS_SITE) as AS_SITE
                        
                          FROM APP_ROLE b
                            LEFT JOIN USER_ROLE a on (a.ID_ROLE=b.ID_ROLE and a.ID_USER=$id)
                          GROUP BY b.ID_ROLE
                    )
                    ORDER BY PREFIX ASC,id_role ASC ";
        $data = DB::select($sql);

        $akses = [];
        $last_prefix='x';
        foreach ($data as $x)
        {
            $p = (Object)[];
            $p->id_user = $x->id_user;

            $as_client = explode('.',$x->as_client);
            $p->controller ='';
            $p->as_client = $x->as_client;
            if(count($as_client) > 1)
            {
               $p->controller = $as_client[1];
            }
            if(count($as_client) == 2)
            {
                $p->as_client = "data";
            }

            if(count($as_client) > 2)
            {
                $p->as_client = "";
                if($as_client[2] =='created')
                {
                    $p->as_client = '.add';
                }
                if($as_client[2] == 'detail')
                {
                    $p->as_client = '.detail';
                }
                if($as_client[2] == 'edit')
                {
                    $p->as_client = '.edit';
                }

            }



            $p->as_site = $x->as_site;
            $p->url = $x->url;
            $p->id_role = $x->id_role;

            if($last_prefix == $x->prefix or $last_prefix == '')
            {
                $p->prefix = '';
            }
            else
            {
                $p->prefix = $x->prefix;
                $last_prefix = $x->prefix;
            }
            $p->prefix = $x->prefix;

            $akses[] = $p;
        }

        $datas['akses'] = $akses;


        $sql = "SELECT
                          max(a.ID_ROLE) as ID_ROLE 
        
                          FROM USER_ROLE a,
                            APP_ROLE b
                        WHERE a.ID_ROLE=b.ID_ROLE
                        and a.id_user=".$id."
                        and a.boleh=1
                        GROUP BY b.id_role";
        $data['roles'] = DB::select($sql);

        $roles = [];
        foreach ($data['roles'] as $x)
        {
            $roles[] = $x->id_role;
        }
        $datas['roles'] =$roles;

        return json_encode($datas,JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = M_Ata::find($id);
        return $data;
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
        DB::delete("Delete from USER_ROLE where id_user=".$id);

        $param = $request->input();
        $param = "'" . join('\', \'',$param) . "'";


        $sql = "INSERT INTO 
            USER_ROLE 
            (ID_USER, ID_ROLE) 
              SELECT $id,id_role
                FROM APP_ROLE
            WHERE ID_ROLE in ($param)";

        if(DB::insert($sql))
        {
            return response()->json(['status'=>'ok' ],200);
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
