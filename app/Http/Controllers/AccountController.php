<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'type' => 'required|string|max:60',
            'currency' => 'required|string|size:3',
            'initial_balance' => 'required|numeric',
        ]);

        $data['user_id'] = auth()->id();
        $data['current_balance'] = $data['initial_balance'];

        Account::create($data);

        return redirect()->route('accounts.index')->with('status', 'Cuenta creada');
    }

    public function destroy(Account $account)
    {
        abort_unless($account->user_id === auth()->id(), 403);
        $account->delete();
        return back()->with('status', 'Cuenta eliminada');
    }
}
