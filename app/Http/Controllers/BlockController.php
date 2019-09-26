<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Block;

class BlockController extends Controller
{
    public static function createGenesis()
    {
        if (count(Block::all()) == 0) {
            $timestamp = Carbon::now()->timestamp * 1000;
            $data = "Genesis Block";
            $hashable = "{\"timestamp\":".$timestamp.",\"prev_hash\":null,\"nonce\":null,\"data\":".$data."}";
            $hash = hash('sha256', $hashable);

            $block = Block::create([
                'data' => $data,
                'hash' => $hash,
                'timestamp' => $timestamp,
                'difficulty' => '0',
            ]);
        }

        return;
    }

    public function index()
    {
        return view('block.index');
    }

    public function requestMine(Request $request)
    {
        $timestamp = Carbon::now()->timestamp * 1000;
        $info = [
            'timestamp' => $timestamp,
            'prev_hash' => Block::orderBy('created_at', 'desc')->first()->hash,
            'nonce' => 0,
            'data' => $request->data,
        ];

        $data = array();

        while(true) {
            $hash = hash('sha256', json_encode($info));

            if ($this->startsWith($hash, $request->difficulty)) {
                $data['hash'] = $hash;
                $data['nonce'] = $info['nonce'];
    
                break;
            }
    
            $info['nonce']++;
        }

        $block = Block::create([
            'hash' => $data['hash'],
            'timestamp' => $timestamp,
            'nonce' => $data['nonce'],
            'prev_hash' => $info['prev_hash'],
            'data' => $request->data,
            'difficulty' => $request->difficulty,
        ]);

        return 'Mined!';
    }

    public function startsWith($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    }
}
