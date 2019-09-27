<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Block extends BaseModel
{
    public function getcompTimeAttribute()
    {
        return Carbon::parse($this->starting_time)->diffInSeconds(Carbon::parse($this->ending_time)) . ' s';
    }
}
