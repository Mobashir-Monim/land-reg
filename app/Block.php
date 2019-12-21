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

    public static function generateUpperLim()
    {
        $lim = '';

        for ($i = 0; $i <= rand(1, 8); $i++) {
            $lim .= self::$hexVals[rand(0, 15)];
        }

        while (strlen($lim) != 64) {
            $lim .= '0';
        }

        return $lim;
    }

    public static function generateLowerLim()
    {
        $lim = "";

        for ($i = 0; $i <= rand(32, 48); $i++) {
            $lim .= self::$hexVals[rand(0, 15)];
        }

        while (strlen($lim) != 64) {
            $lim = '0'.$lim;
        }

        return $lim;
    }

    public static function chainable($data)
    {
        $upper = hexdec($data['upper_limit']);
        $lower = hexdec($data['lower_limit']);
        $hash = hexdec($data['hash']);
        if ($hash < $lower || $hash > $upper)
            return false;

        if (!is_null(Block::where('hash', $data['hash']->first())))
            return false;
        
        return true;
    }

    public static function generateDataBlock($transaction)
    {
        return [
            'hash' => '',
            'upper_limit' => Block::generateUpperLim(),
            'lower_limit' => Block::generateLowerLim(),
            'start_val' => 0,
            'end_val' => null,
            'block_data' => [
                'txid' => $transaction->id,
                'from' => $transaction->from,
                'to' => $transaction->to,
                'specifics' => $transaction->specifics,
                'file' => $transaction->document,
                'ext' => $transaction->ext,
                'nonce' => 0,
                'prev_hash' => null,
                'timestamp' => null,
            ],
        ];
    }

    // Check if string starts with pattern
    // if (!(substr($string, 0, strlen($startString)) == $startString))
    //     return false;
}
