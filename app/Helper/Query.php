<?php
/**
 * Created by PhpStorm.
 * User: ojiepermana
 * Date: 12/19/2016
 * Time: 12:20 PM
 */

namespace App\Helper;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Object_;
use Tymon\JWTAuth\Facades\JWTAuth;


class Query
{


    public static function pagination($sql,$page)
    {
        $data = (Object)[];
        $data->total = count(DB::select($sql));
        $data->perpage = 100;
        $data->current_page = $page;

        $roun = round($data->total / 100, 0, PHP_ROUND_HALF_DOWN);
        $data->last_page = ($data->total >100 ? 1:0) + $roun;

        $sql.=  '  OFFSET '.($page-1).'*100
            LIMIT 100 ';
        $data->data = DB::select($sql);

        return $data;

    }

    public static $Perpage = 100;

    public static function getSite()
    {

        return (Object)array("id"=> 121, "code_site"=>"JKT");

    }

    public static function getPosisi()
    {

        return  (object)array("id"=> 1, "position"=>"MPC");
    }

    public static function getUser()
    {
        return JWTAuth::toUser(JWTAuth::getToken());

        return  (object)array("id"=> 1, "name"=>"Mumahammad Arifin");
    }



}
