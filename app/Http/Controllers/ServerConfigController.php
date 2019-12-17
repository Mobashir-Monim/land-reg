<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServerConfig;
use App\Node;

class ServerConfigController extends Controller
{
    public function configAll(Request $request)
    {

    }

    public function selfConfig(Request $request)
    {
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', file_get_contents('http://checkip.dyndns.com/'), $m);
        $externalIp = $m[1];

        ServerConfig::create(['name' => 'ip', 'description' => 'Internet Protocol of server in IPv4', 'value' => $externalIp]);
        
    }

    public function index()
    {
        return view('nodes.config.index');
    }

    public function create()
    {
        return view('nodes.config.create');
    }

    public function store(Request $request)
    {
        set_time_limit(600);
        $responses = array();

        foreach (Node::all() as $node) {
            if ($node->ip == ServerConfig::getVal('ip')) {
                ServerConfig::create(['name' => $request->name, 'description' => $request->description, 'value' => $request->value[$node->ip]]);
                $responses[$node->ip] = ['success' => true, 'message' => 'self'];   
            } else {
                $data = [
                    'ip' => ServerConfig::getVal('ip'),
                    'name' => $request->name,
                    'description' => $request->description,
                    'value' => $request->value[$node->ip]
                ];
                $reponse = $response = $this->postData("http://$node->ip/api/server-config/store", $data);
                $responses[$node->ip] = json_decode($response->getBody()->getContents())->success;
            }
        }

        dd(json_encode($responses));

        return redirect(route('server.config.index')."?responses=");
    }

    public function storeAPI(Request $request)
    {
        ServerConfig::create(['name' => $request->data['name'], 'description' => $request->data['description'], 'value' => $request->data['value']]);

        return response()->json([
            'success' => true,
            'message' => $request->data['name'].' stored successfully',
        ]);
    }

    public function show(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Retrieved '.$request->data['name'],
            'data' => [
                'value' => ServerConfig::getVal($request->data['name']),
            ],
        ]);
    }

    public function edit(Request $request, $name)
    {
        $responses = array();

        foreach (Node::all() as $node) {
            if ($node->ip == ServerConfig::getVal('ip')) {
                $responses[$node->ip] = ServerConfig::getVal($name);
            } else {
                $reponse = $response = $this->postData("http://$node->ip/api/server-config/fetch", ['ip' => ServerConfig::getVal('ip'), 'name' => $name]);
                $responses[$node->ip] = json_decode($response->getBody()->getContents())->data['value'];
            }
        }

        return view('nodes.config.alter', compact('responses'));
    }

    public function update(Request $request, ServerConfig $serverConfig)
    {
        //
    }

    public function destroy(ServerConfig $serverConfig)
    {
        
    }
}
