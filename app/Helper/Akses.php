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


class Akses
{


    public static function getGuru()
    {

        return (Object)array("id"=> 4, "nama"=>"Desi Handayani");

    }



}
