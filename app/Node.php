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

    public function getNode($ip)
    {
        return $this->where('ip', $ip)->first();
    }

    public function childNumber()
    {
        if ($this->parent == null) {
            return null;
        }

        foreach ($this->parent->children as $key => $child) {
            if ($child->ip == $this->ip) {
                return ($key + 1);
            }
        }
    }
}
