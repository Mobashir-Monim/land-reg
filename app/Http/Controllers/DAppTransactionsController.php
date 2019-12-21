<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Node;
use App\Block;

class DAppTransactionsController extends Controller
{
    public function addTransaction()
    {
        return view('dApp.transactions.create');
    }

    public function getAreasArray()
    {
        $areas = array_keys(Node::where('area_id', '!=', 0)->pluck('id', 'area_id')->toArray());
        $this->shuffle_assoc($areas);
        array_splice($areas, rand(0, sizeof($areas) - 1), 1);
        return array_fill_keys($areas, 0);
    }

    public function getClustersArray($area)
    {
        $clusters = array_keys(Node::whereNull('parent_id')->where('area_id', $area)->first()->children->where('area_id', $area)->pluck('id', 'ip')->toArray());
        $this->shuffle_assoc($clusters);
        array_splice($clusters, rand(0, sizeof($clusters) - 1), 1);
        return array_fill_keys($clusters, 0);
    }

    public function getNodesArray($parent)
    {
        $nodes = array_keys(Node::where('ip', $parent)->first()->children->pluck('id', 'ip')->toArray());
        $this->shuffle_assoc($nodes);
        array_splice($nodes, rand(0, sizeof($nodes) - 1), 1);
        return array_fill_keys($nodes, 0);
    }

    public function processTransaction(Request $request)
    {
        $transaction = (is_null($request->txid) ? (new TransactionsController)->store($request) : Transaction::find($request->txid));
        $candidates = ['areas' => $this->getAreasArray(), 'clusters' => null, 'nodes' => null];
        $elected = ['area' => null, 'cluster' => null, 'node' => null];

        foreach ($candidates as $key => $candidate) {
            $singular = substr($key, 0, -1);
            $elected[$singular] = $this->startElection($candidates, $key, $singular);

            if ($key == 'areas')
                $candidates['clusters'] = $this->getClustersArray($elected[$singular]);
            elseif ($key == 'clusters')
                $candidates['nodes'] = $this->getNodesArray($elected[$singular]);
        }

        $data = Block::generateDataBlock($transaction);
        
        return view('dApp.demo.elected', compact('data', 'elected'));
    }

    public function startElection($candidates, $key, $singular)
    {
        if (sizeof($candidates[$key]) == 1)
            return array_keys($candidates[$key])[0];

        foreach (Node::where('type', 1)->get() as $council) {
            $response = $this->postData("http://$council->ip/api/elect/$singular", ['ip' => $this->selfIP(), $key => $candidates[$key]]);
            ++$candidates[$key][json_decode($response->getBody()->getContents())->data->$singular];
        }

        return array_keys($candidates[$key], max($candidates[$key]))[0];
    }

    public function getTransaction(Request $request, Transaction $transaction)
    {
        return response()->json([
            'txid' => $transaction->id,
            'from' => $transaction->from,
            'to' => $transaction->to,
            'file' => base64_encode(file_get_contents($transaction->document)),
        ]);
    }

    public function mine(Request $request)
    {
        $elected = json_decode($request->elected);
        $response = $this->postData("http://$elected->node/api/mine/block", ['ip' => $this->selfIP(), 'mine_data' => json_encode($request->data)]);
        
        return view('dApp.demo.done', compact('elected'));
    }
}
