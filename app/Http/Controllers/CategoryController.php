<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $items = Category::where('user_id', auth()->id())->get();
        return view('categories.index', compact('items'));
    }

    public function create() { return view('categories.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:120',
            'kind'=>'required|in:income,expense',
            'icon'=>'nullable|string|max:120',
        ]);
        $data['user_id'] = auth()->id();
        Category::create($data);
        return redirect()->route('categories.index')->with('status','Categoría creada');
    }

    public function destroy(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);
        $category->delete();
        return back()->with('status','Categoría eliminada');
    }
}
