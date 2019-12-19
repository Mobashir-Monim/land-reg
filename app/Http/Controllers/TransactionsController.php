<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionsController extends Controller
{
    public function store(Request $request)
    {
        $doc = [null, null];

        if ($request->hasFile('doc')) {
            $doc[0] = base64_encode(file_get_contents($request->file('doc')));
            $doc[1] = $request->file('doc')->getClientOriginalExtension();
        }

        $transaction = Transaction::create([
            'from' => $request->transfer_from,
            'to' => $request->transfer_to,
            'specifics' => $request->specifics,
            'document' => $doc[0],
            'ext' => $doc[1],
        ]);

        return $transaction;
    }
}
