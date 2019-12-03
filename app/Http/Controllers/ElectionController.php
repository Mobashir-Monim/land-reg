<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ElectionController extends Controller
{
    public function area(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Elected an area',
            'data' => [
                'area' => array_rand($request->data['areas'], 1),
            ],
        ]);
    }

    public function cluster(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Elected a cluster',
            'data' => [
                'cluster' => array_rand($request->data['clusters'], 1),
            ],
        ]);
    }
    
    public function node(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Elected a cluster',
            'data' => [
                'node' => array_rand($request->data['nodes'], 1),
            ],
        ]);
    }
}
