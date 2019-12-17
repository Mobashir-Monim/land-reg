<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\ServerConfig;

class NodesController extends Controller
{
    public function compDump(Request $request)
    {
        set_time_limit(600);
        $responses = array();
        
        foreach (Node::all() as $node) {
            $response = $this->postData("http://$node->ip/api/comp-dump", ['ip' => $this->selfIP()]);
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

    public function dbCleanIndex(Request $request)
    {
        set_time_limit(600);
        $responses = array();
        $last = null;
        
        foreach (Node::all() as $node) {
            if ($node->ip == $this->selfIP()) {
                $last = $node;
            } else {
                $response = $this->postData("http://$node->ip/api/mig-reseed", ['ip' => $this->selfIP()]);
                $responses[$node->ip] = json_decode($response->getBody()->getContents());
            }
        }

        $response = $this->postData("http://$last->ip/api/mig-reseed", ['ip' => $this->selfIP()]);
        $responses[$node->ip] = json_decode($response->getBody()->getContents());

        return response()->json([
            'success' => true,
            'message' => 'Responses as presented in data segment',
            'data' => [
                'responses' => $responses,
            ]
        ]);
    }

    public function dbClean(Request $request)
    {
        exec("cd .. ; php artisan migrate:refresh --seed", $resp);

        return response()->json([
            'success' => true,
            'message' => $resp,
        ]);
    }
}
