<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerConfig extends BaseModel
{
    public function getVal($name)
    {
        try {
            return $this->getConf($name)->value;
        } catch (\Exception $e) {
            // return [null, $e, $name, self::getConf($name), self::where('name', $name)->get()];
            return null;
        }
    }

    public function getConf($name)
    {
        return $this->where('name', $name)->first();
    }
}
