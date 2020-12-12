<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function flog()
    {
        if (auth()->user()->first_login == '0') {
            Account::create([
                'iban' => 'LV99MEGA' . app()->make('generateIban'),
                'balance' => 0,
                'currency' => 'EUR',
                'type' => 'basic',
                'user_id' => auth()->user()->id
            ]);
            auth()->user()->first_login = '1';
            auth()->user()->save();
        }

        return redirect()->route('accounts');
    }

    public function show()
    {
        $accounts = auth()->user()->accounts;
        $debt = auth()->user()->debt;

        return view('accounts.show', [
            'accounts' => $accounts,
            'debt' => $debt
        ]);
    }

    public function debt()
    {
        if (auth()->user()->debt == '0') {
            Account::create([
                'iban' => 'LV99MEGA' . app()->make('generateIban'),
                'balance' => 200000,
                'currency' => 'EUR',
                'type' => 'credit line',
                'user_id' => auth()->user()->id
            ]);
            auth()->user()->debt = '1';
            auth()->user()->save();
        }
        return redirect()->route('accounts');
    }

    public function send()
    {
        $sendToAccount = Account::where('iban', $_POST['sendTo'])->first();
        $sendFromAccount = Account::where('iban', $_POST['sendFrom'])->first();
        $amount = (int)($_POST['amount'] * 100);

        if ($sendToAccount == null) {
            dd('cant find account');
        }

        if ($sendFromAccount->balance < $amount) {
            dd('insuficent funds');
        }

        if ($sendToAccount->currency == $sendFromAccount->currency) {
            $rate = 1;
            $toCurrency = 'EUR';
        }

        if ($sendToAccount->iban != $sendFromAccount->iban) {
            $sendToAccount->balance += $amount;
            $sendToAccount->save();

            $sendFromAccount->balance -= $amount;
            $sendFromAccount->save();
        }

        Transaction::create([
            'fromAccount' => $_POST['sendFrom'],
            'fromCurrency' => $_POST['currency'],
            'amount' => $amount,
            'rate' => $rate,
            'toCurrency' => $toCurrency,
            'toAccount' => $_POST['sendTo'],
            'status' => 'finished',
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('accounts');
    }

}
