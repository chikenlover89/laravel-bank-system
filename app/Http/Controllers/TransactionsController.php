<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function show()
    {
        $transactions = auth()->user()->transactions;

        return view('accounts.history', [
            'transactions' => $transactions,
        ]);
    }
}
