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

    public static function updateAll($blocks)
    {
        // exec("cd .. ; php artisan migrate:rollback --step=1 ; php artisan migrate");

        foreach ($blocks as $block) {
            // $block->id = $blocks[$key]->id;
            // $block->hash = $blocks[$key]->hash;
            // $block->timestamp = $blocks[$key]->timestamp;
            // $block->nonce = $blocks[$key]->nonce;
            // $block->prev_hash = $blocks[$key]->prev_hash;
            // $block->data = $blocks[$key]->data;
            // $block->difficulty = $blocks[$key]->difficulty;
            // $block->starting_time = $blocks[$key]->starting_time;
            // $block->ending_time = $blocks[$key]->ending_time;
            // $block->created_at = $blocks[$key]->created_at;
            // $block->updated_at = $blocks[$key]->updated_at;
            // $block->save();
            $this->create([$block]);
        }
    }
}
