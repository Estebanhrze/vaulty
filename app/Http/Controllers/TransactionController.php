<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Transaction::with(['account','category'])
            ->where('user_id', auth()->id())
            ->latest('date')->paginate(20);

        return view('transactions.index', compact('items'));
    }

    public function create()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        $categories = Category::where('user_id', auth()->id())->get();
        return view('transactions.create', compact('accounts','categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'account_id'=>'required|exists:accounts,id',
            'category_id'=>'nullable|exists:categories,id',
            'transfer_account_id'=>'nullable|exists:accounts,id|different:account_id',
            'type'=>'required|in:income,expense,transfer',
            'amount'=>'required|numeric|min:0.01',
            'date'=>'required|date',
            'description'=>'nullable|string|max:1000',
        ]);

        $data['user_id'] = auth()->id();

        DB::transaction(function () use ($data) {
            $tx = Transaction::create($data);

            // Ajustar balances
            $account = $tx->account;
            if ($tx->type === 'income') {
                $account->increment('current_balance', $tx->amount);
            } elseif ($tx->type === 'expense') {
                $account->decrement('current_balance', $tx->amount);
            } else { // transfer
                $account->decrement('current_balance', $tx->amount);
                if ($tx->transfer_account_id) {
                    Account::where('id',$tx->transfer_account_id)->increment('current_balance', $tx->amount);
                }
            }
        });

        return redirect()->route('transactions.index')->with('status','Transacción creada');
    }

    public function destroy(Transaction $transaction)
    {
        abort_unless($transaction->user_id === auth()->id(), 403);
        $transaction->delete();
        return back()->with('status','Transacción eliminada');
    }
}
