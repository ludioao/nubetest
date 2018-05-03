<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 25/04/18
 * Time: 19:56
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Template extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'template';
    }

}