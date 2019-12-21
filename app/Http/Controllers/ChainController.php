<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\Block;
use App\ServerConfig;

class ChainController extends Controller
{
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
