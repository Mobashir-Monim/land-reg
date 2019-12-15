<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;

class NodesController extends Controller
{
    public function gitPull(Request $request)
    {
        set_time_limit(600);
        $responses = array();
        dd($_SERVER['REMOTE_ADDR'], $request->root()->ip());
        foreach (Node::all() as $node) {
            $response = $this->postData("http://$node->ip/api/git-pull", ['ip' => $request->ip()]);
            $responses[$node->ip] = json_decode($response->getBody()->getContents());
        }

        return response()->json([
            'success' => true,
            'message' => 'Responses as presented in data segment',
            'data' => [
                'responses' => $responses,
            ]
        ]);
    }

    public function compDump(Request $request)
    {
        set_time_limit(600);
        $responses = array();
        
        foreach (Node::all() as $node) {
            $response = $this->postData("http://$node->ip/api/comp-dump", ['ip' => $request->ip()]);
            $responses[$node->ip] = json_decode($response->getBody()->getContents())->success;
        }

        return response()->json([
            'success' => true,
            'message' => 'Responses as presented in data segment',
            'data' => [
                'responses' => $responses,
            ]
        ]);
    }

    public function reseed(Request $request)
    {
        set_time_limit(600);
        $responses = array();
        
        foreach (Node::all() as $node) {
            $response = $this->postData("http://$node->ip/api/mig-reseed", ['ip' => $request->ip()]);
            $responses[$node->ip] = json_decode($response->getBody()->getContents())->success;
        }

        return response()->json([
            'success' => true,
            'message' => 'Responses as presented in data segment',
            'data' => [
                'responses' => $responses,
            ]
        ]);
    }
}
