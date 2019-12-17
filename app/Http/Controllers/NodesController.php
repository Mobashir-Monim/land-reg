<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\ServerConfig;

class NodesController extends Controller
{
    public function gitIndex(Request $responses)
    {
        return view('nodes.git.index');
    }

    public function gitPull(Request $request)
    {
        set_time_limit(600);
        $responses = array();

        foreach (Node::all() as $node) {
            if ($node->ip == ServerConfig::getVal('ip')) {
                $resp = exec('sudo su ; cd .. ; git pull');
                $responses[$node->ip] = ['success' => true, 'message' => $resp];
            } else {
                $response = $this->postData("http://$node->ip/api/git-pull", ['ip' => ServerConfig::getVal('ip')]);
                $responses[$node->ip] = json_decode($response->getBody()->getContents());
            }
        }

        dd($responses);

        return back()->with('responses', $responses);
    }

    public function pullCode(Request $request)
    {
        exec('cd .. ; git pull https://ingeniousartist:01552344763@gitlab.com/mobashir-monim/land-reg', $resp);

        return response()->json([
            'success' => true,
            'message' => $resp,
        ]);
    }

    public function compDump(Request $request)
    {
        set_time_limit(600);
        $responses = array();
        
        foreach (Node::all() as $node) {
            $response = $this->postData("http://$node->ip/api/comp-dump", ['ip' => ServerConfig::getVal('ip')]);
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
            $response = $this->postData("http://$node->ip/api/mig-reseed", ['ip' => ServerConfig::getVal('ip')]);
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
