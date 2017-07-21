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


class Query
{


    public static function pagination()
    {

        $sql =  '  OFFSET 2*2
            LIMIT 2 ';

        return $sql;

    }



}
