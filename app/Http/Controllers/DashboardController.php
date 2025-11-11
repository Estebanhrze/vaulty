<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $accounts = Account::where('user_id', $userId)->get();
        $balance = $accounts->sum('current_balance');

        $lastTransactions = Transaction::with(['account','category'])
            ->where('user_id', $userId)
            ->latest('date')->take(10)->get();

        return view('dashboard', compact('accounts','balance','lastTransactions'));
    }
}
