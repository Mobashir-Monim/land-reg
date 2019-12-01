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
            'message' => 'Elected a node',
            'data' => [
                'area' => array_rand($request->data['areas'], 1),
            ],
        ]);
    }
}
