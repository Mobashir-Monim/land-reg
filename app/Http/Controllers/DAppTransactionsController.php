<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Node;

class DAppTransactionsController extends Controller
{
    public function getAreasArray()
    {
        $areas = array_keys(Node::all()->pluck('id', 'area_id')->toArray());
        array_splice($areas, rand(0, sizeof($areas) - 1), 1);
        return array_fill_keys($areas, 0);
    }

    public function processTransaction(Request $request)
    {
        // $transaction = Transaction::create(['from' => $request->from, 'to' => $request->to, 'specifics' => $request->specifics]);

        // save file if it exists

        $areas = $this->getAreasArray();
        $area = null;


        while (true) {
            foreach (Node::where('type', 1)->get() as $council) {
                $response = $this->postData("http://$council->ip/api/elect/area", ['areas' => $areas]);
                ++$areas[json_decode($response->getBody()->getContents())->data->area];
            }

            if ($this->hasMajority($areas))
                break;
        }

        $area = array_keys($areas, max($areas))[0];
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
}
