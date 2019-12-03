<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends BaseModel
{
    public function children()
    {
        return $this->hasMany('App\Node', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Node', 'parent_id');
    }
}
