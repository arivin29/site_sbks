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


class Variable
{


    public static function kelas()
    {

        return [10,11,12];

    }

    public static function getLeveluser()
    {

        return ['guru','murid','ortu'];

    }
    public static function paralel()
    {

        return ['A','B','C','D','EX 1','EX 2'];

    }

    public static function getSemester()
    {

        return 1; //->semester genap

    }

    public static function getCurrentSmt()
    {

        return 1;

    }
    public static function getTahunAjar()
    {

        return '2017/2018'; //->semester genap

    }

    public static function smt_out()
    {

        return [['var'=>1,'value'=>'Ganjil'],['var' => 0, 'value' =>'Genap']]; //->semester genap

    }



}
