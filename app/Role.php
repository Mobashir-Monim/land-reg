<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
    public function roles()
    {
        return $this->belongsToMany('App\User');
    }
}
