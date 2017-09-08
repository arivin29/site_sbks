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

        return (Object)array("id_guru"=> 27, "nama"=>"Desi Handayani");

    }



}
