<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;

class MineController extends Controller
{
    public function processMine(Request $request)
    {
        // $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        // $ip = $_SERVER['REMOTE_ADDR'];
        // dd($ip);
        set_time_limit(3660);
        $chains_details = $this->findConsentingChain();
        $this->truncateChain($chains_details);
        dd($chains_details);
        
    }

    // public function mine

    public function mine(Request $request)
    {

    }
    
    public function findConsentingChain()
    {
        while (true) {
            $chains_details = $this->geneticConsensus();

            if ($this->reachedConsensus($chains_details)) {
                return $chains_details;
            }
        }
    }
    
    public function reachedConsensus($chains_details)
    {
        if ($this->hasMajority($chains_details['chains']))
            return true;
        else
            return false;
    }

    public function geneticConsensus()
    {
        $nodes = Node::all()->shuffle()->whereNotIn('ip', $_SERVER['REMOTE_ADDR'])->take(rand((1 + count(Node::all())), (3 * count(Node::all()) / 4)))->toArray();
        $chains_details = ['chains' => array(), 'ips' => array(), 'self' => (new \App\Http\Controllers\ChainController)->leadingChain()];
        
        foreach ($nodes as $node) {
            $response = $this->postData("http://".$node['ip']."/api/chain/header", ['ip' => $_SERVER['REMOTE_ADDR']]);
            $chains_details = $this->processChain($chains_details, $node['ip'], json_decode($response->getBody()->getContents())->data->chain);
        }

        return $chains_details;
    }

    public function processChain($chains_details, $ip, $chain)
    {
        if (array_key_exists($chain, $chains_details['chains'])) {
            $chains_details['chains'][$chain]++;
        } else {
            $chains_details['chains'][$chain] = 1;
            $chains_details['ips'][$chain] = $ip;
        }

        return $chains_details;
    }

    public function truncateChain($chains_details)
    {
        $majority = array_keys($chains_details['chains'], max($chains_details['chains']))[0];

        if ($chains_details['self'] != $majority) {
            $response = $this->fetchData("http://".$chains_details['ips'][$majority]."/api/blocks/send");
            Block::updateAll(json_decode($response->getBody()->getContents())->data->blocks);
        }

        return;
    }
}
