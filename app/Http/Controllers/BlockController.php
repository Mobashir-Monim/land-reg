<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Block;
use App\MineData;

class BlockController extends Controller
{
    public static function createGenesis()
    {
        if (count(Block::all()) == 0) {
            $timestamp = Carbon::parse('8th Sept 1996')->timestamp * 1000;
            $data = "Genesis Block";
            $hashable = "{\"timestamp\":".$timestamp.",\"prev_hash\":null,\"nonce\":null,\"data\":".$data."}";
            $hash = hash('sha256', $hashable);

            $block = Block::create([
                'data' => $data,
                'hash' => $hash,
                'timestamp' => $timestamp,
                'difficulty' => '0',
                'starting_time' =>  Carbon::createFromTimestamp($timestamp/1000)->toDateTimeString(),
                'ending_time' => Carbon::createFromTimestamp($timestamp/1000)->toDateTimeString(),
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
        // return response()->json([
        //     'status' => $request->all()
        // ]);
        dd($request->block_data);
        set_time_limit(3660);
        $timestamp = Carbon::now()->timestamp * 1000;
        $start = Carbon::now()->toDateTimeString();

        $info = [
            'timestamp' => $timestamp,
            'prev_hash' => Block::orderBy('created_at', 'desc')->first()->hash,
            'nonce' => 0,
            'data' => $request->block_data,
        ];

        $data = array();

        while(true) {
            $hash = hash('sha256', json_encode($info));
            
            if ($this->startsWith($hash, $request->upper_limit)) {
                $data['hash'] = $hash;
                $data['nonce'] = $info['nonce'];
    
                break;
            }
    
            $info['nonce']++;
        }

        $end = Carbon::now()->toDateTimeString();

        $block = Block::create([
            'hash' => $data['hash'],
            'timestamp' => $timestamp,
            'nonce' => $data['nonce'],
            'prev_hash' => $info['prev_hash'],
            'data' => $request->block_data,
            'difficulty' => $request->upper_limit,
            'starting_time' =>  $start,
            'ending_time' => $end,
        ]);

        // return response()->json([
        //     'status' => 'done',
        //     'hash' => $hash,
        //     'nonce' => $info['nonce'],
        // ]);

        return back();
    }

    public function reset()
    {
        $path = exec('pwd');
        $dirs = explode('/', $path);

        for ($i = 0; $i < sizeof($dirs) - 1; $i++) {
            if ($i) {
                $path = $path.'/'.$dirs[$i];
            } else {
                $path = '';
            }
        }

        exec($path.'/reset-db.sh');

        return redirect(route('blocks'));
    }

    public function sendBlocks(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Retrieved block',
            'data' => [
                'blocks' => Block::all(),
            ],
        ]);
    }

    public function mined(Request $request, $txid)
    {
        $data = MineData::where('txid', $txid)->first()->data;
        dd($data);
        return view('dApp.demo.mined', compact('data'));
    }
}
