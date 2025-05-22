<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }


    public function show(Category $category)
    {
        // Make sure the category belongs to the authenticated user
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $instruments = $category->instruments;

        return view('categories.show', compact('category', 'instruments'));
    }


    public function edit(Category $category)
    {
        // Make sure the category belongs to the authenticated user
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Make sure the category belongs to the authenticated user
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }


    public function destroy(Category $category)
    {
        // Make sure the category belongs to the authenticated user
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
