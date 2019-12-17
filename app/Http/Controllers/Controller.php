<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function startsWith($string, $startString) 
    { 
        return (substr($string, 0, strlen($startString)) == $startString);
    }

    public function fetchData($url)
    {

    }

    public function selfIP()
    {
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', file_get_contents('http://checkip.dyndns.com/'), $m);
        return $m[1];
    }

    public function postData($url, $data)
    {
        $client = new Client();

        return $client->request('POST', $url, [
            'form_params' => [
                'data' => $data,
            ]
        ]);
    }

    public function hasMajority($array)
    {
        arsort($array);
        $keys = array();

        foreach ($array as $key => $val) {
            array_push($keys, $key);

            if (sizeof($keys) == 2)
                break;
        }

        if (sizeof($array) > 1) {
            if ($array[$keys[0]] == $array[$keys[1]])
                return false;
        }

        return true;
    }

    public function shuffle_assoc($array)
	{
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;

        return $array;
    }
}
