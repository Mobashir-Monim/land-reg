<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Block extends BaseModel
{
    protected static $hexVals = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];

    public function getcompTimeAttribute()
    {
        return Carbon::parse($this->starting_time)->diffInSeconds(Carbon::parse($this->ending_time)) . ' s';
    }

    public static function updateAll($blocks)
    {
        exec("cd .. ; php artisan migrate:rollback --step=1 ; php artisan migrate");

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

    public static function generateDifficulty()
    {
        $difficulty = '';

        for ($i = 0; $i <= rand(1, 8); $i++) {
            $difficulty .= self::$hexVals[rand(0, 15)];
        }

        return $difficulty;
    }

    public static function chainable($data)
    {
        if (!(substr($string, 0, strlen($startString)) == $startString))
            return false;

        if (!is_null(Block::where('hash', $data['hash']->first())))
            return false;
        
        return true;
    }
}
