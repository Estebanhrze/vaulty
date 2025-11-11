<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $items = Budget::with('category')
            ->where('user_id', auth()->id())->latest()->get();
        return view('budgets.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())
            ->where('kind','expense')->get();
        return view('budgets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'=>'nullable|exists:categories,id',
            'year'=>'required|integer|min:2000|max:2099',
            'month'=>'required|integer|min:1|max:12',
            'limit_amount'=>'required|numeric|min:0',
        ]);
        $data['user_id'] = auth()->id();
        $data['spent_amount'] = 0;
        Budget::create($data);
        return redirect()->route('budgets.index')->with('status','Presupuesto creado');
    }

    public function destroy(Budget $budget)
    {
        abort_unless($budget->user_id === auth()->id(), 403);
        $budget->delete();
        return back()->with('status','Presupuesto eliminado');
    }
}
