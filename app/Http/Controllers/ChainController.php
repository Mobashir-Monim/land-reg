<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\Block;
use App\ServerConfig;
use App\MineData;
use App\ChainData;

class ChainController extends Controller
{
    public function chainRequest(Request $request, $txid)
    {
        $self = Node::where('ip', $this->selfIP())->first();
        $message = "Find chain request at ";
        $chainData = ChainData::where('txid', $txid)->first();

        if (is_null($self->parent)) {
            $councils = Node::where('type', 1)->whereNotIn('ip', [$self->ip])->get();

            foreach ($councils as $council) {
                $response = $this->postData("http://$council->ip/api/blocks/chain/$txid", ['ip' => $self->ip, 'chain_data' => json_encode($chainData->data)]);
                $message .= "$council->ip/blocks";
            }
        } else {
            $parent = $self->parent;
            dd(['ip' => $self->ip, 'chain_data' => $chainData->data]);
            $response = $this->postData("http://$parent->ip/api/blocks/chain/$txid", ['ip' => $self->ip, 'chain_data' => json_encode($chainData->data)]);
            $message .= "$parent->ip/blocks/chain/$txid/request";
        }

        $chainData->requested = true;
        $chainData->save();

        return back()->with('success', $message);
    }

    public function chainData(Request $request, $txid)
    {
        $data = json_decode(ChainData::where('txid', $txid)->first()->data, true);

        return view('dApp.demo.mined', compact('data'));
    }

    public function process(Request $request, $txid)
    {
        $chainData = ChainData::create(['txid' => $txid, 'data' => json_encode($request['data']['chain_data'])]);

        return response()->json([
            'success' => true,
            'message' => 'Chain Data stored'
        ]);
    }

    public function leadingChain()
    {
        $blocks = Block::all()->sortByDesc('id')->take(5);
        $chain = "";

        foreach ($blocks as $block) {
            $chain .= $block->hash;
        }

        return $chain;
    }

    public function sendLeading(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Retrieved chain',
            'data' => [
                'chain' => $this->leadingChain(),
            ],
        ]);
    }

    // public function notifyChildren()
    // {
    //     $node = 
    // }
}
