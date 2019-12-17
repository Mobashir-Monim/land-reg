<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerConfig extends BaseModel
{
    public static function getVal($name)
    {
        try {
            return self::getConf($name)->value;
        } catch (\Exception $e) {
            // return [null, $e, $name, self::getConf($name), self::where('name', $name)->get()];
            return null;
        }
    }

    public static function getConf($name)
    {
        return self::where('name', $name)->first();
    }
}
