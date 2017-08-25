<?php
/**
 * Created by PhpStorm.
 * User: ojiepermana
 * Date: 12/19/2016
 * Time: 12:20 PM
 */

namespace App\Helper;
use DB;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Tymon\JWTAuth\Facades\JWTAuth;


class Query
{


    public static function pagination()
    {

        $sql =  '  OFFSET 2*2
            LIMIT 2 ';

        return $sql;

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
