<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\MineData;
use Carbon\Carbon;

class MineController extends Controller
{
    public function processMine(Request $request)
    {
        set_time_limit(43260);
        $chains_details = $this->findConsentingChain();
        $this->truncateChain($chains_details);
        $start = Carbon::now()->toDateTimeString();
        $data = json_decode($request->data);
        MineData::create(['data' => $request->data, 'txid' => $data->block_data->txid]);
        
        return;
    }

    // public function mine($data, $start, $limit)
    public function mine($data)
    {
        MineData::create([]);
        $data = json_decode($data);
        $timestamp = Carbon::now()->timestamp * 1000;
        $data['block_data']['timestamp'] = $timestamp;
        $data['block_data']['prev_hash'] = Block::orderBy('created_at', 'desc')->first()->hash;

        while(true) {
            $data['hash'] = hash('sha256', json_encode($data['block_data']));
            
            if (Block::chainable($data))
                break;
    
            $data['block_data']['nonce']++;

            if ($this->timelimitCheck($start, $limit))
                $this->requestSubzoneLock($data);
                break;
        }

        $end = Carbon::now()->toDateTimeString();
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
        $nodes = Node::all()->shuffle()->whereNotIn('ip', $this->selfIP())->take(rand((1 + count(Node::all())), (3 * count(Node::all()) / 4)))->toArray();
        $chains_details = ['chains' => array(), 'ips' => array(), 'self' => (new \App\Http\Controllers\ChainController)->leadingChain()];
        
        foreach ($nodes as $node) {
            $response = $this->postData("http://".$node['ip']."/api/chain/header", ['ip' => $this->selfIP()]);
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
