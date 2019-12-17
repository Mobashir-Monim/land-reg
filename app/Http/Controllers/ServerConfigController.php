<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServerConfig;
use App\Node;

class ServerConfigController extends Controller
{
    public function configAll(Request $request)
    {
        $responses = array();

        foreach (Node::all() as $node) {
            if ($node->ip == $this->selfIP() || is_null($this->selfIP())) {
                $responses[$node->ip] = $this->selfConfig();
            } else {
                $response = $this->postData("http://$node->ip/api/server-config/self", ['ip' => $this->selfIP()]);
                $responses[$node->ip] = json_decode($response->getBody()->getContents());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Done calling',
            'responses' => $responses,
        ]);
    }

    public function callSelfConfig(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => $this->selfConfig(),
            'return' => $request->all(),
        ]);
    }

    public function selfConfig()
    {
        $externalIp = $this->selfIP();
        $node = Node::getNode($externalIp);
        $type = $node->type == 1 ? 'Council' : ($node->type == 2 ? 'Information' : 'Computational');
        $name = $node->type == 1 ? 'Council '.$node->area_id : ($node->type == 2 ? 'Information '.$node->area_id.' - '.$node->childNumber() : 'Computational '.$node->area_id.' - '.$node->parent->childNumber().' - '.$node->childNumber());
        $items = [
            ['name' => 'ip', 'description' => 'Internet Protocol of server in IPv4', 'value' => $externalIp],
            ['name' => 'area', 'description' => 'The zone of the node in the architecture', 'value' => $node->area_id],
            ['name' => 'type', 'description' => 'The type of the node in the hierarchy', 'value' => $type],
            ['name' => 'name', 'description' => 'The name of the node in the architecture', 'value' => $name],
        ];
        $resp = array();

        foreach ($items as $item) {
            try {
                ServerConfig::create($item);
                array_push($resp, $item['name'].' set');
            } catch (\Exception $e) {
                array_push($resp, $item['name'].' already set');
            }
        }

        return $resp;
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
            if ($node->ip == $this->selfIP()) {
                ServerConfig::create(['name' => $request->name, 'description' => $request->description, 'value' => $request->value[$node->ip]]);
                $responses[$node->ip] = ['success' => true, 'message' => 'self'];   
            } else {
                $data = [
                    'ip' => $this->selfIP(),
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
        $config = array();

        foreach (Node::all() as $node) {
            if ($node->ip == $this->selfIP()) {
                $responses[$node->ip] = ServerConfig::getVal($name);
                $config['name'] = $name;
                dd(ServerConfig::where('name', $name)->first(), $name, ServerConfig::all());
                $config['description'] = ServerConfig::where('name', $name)->first()->description;
            } else {
                $reponse = $response = $this->postData("http://$node->ip/api/server-config/fetch", ['ip' => $this->selfIP(), 'name' => $name]);
                $responses[$node->ip] = json_decode($response->getBody()->getContents());
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
