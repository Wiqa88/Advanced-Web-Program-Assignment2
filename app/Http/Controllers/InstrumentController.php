<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Category;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Instrument::query();

        // Search feature
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('brand', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Sort by name
        $query->orderBy('name', 'asc');

        // Page through results
        $instruments = $query->paginate(5);

        return view('instruments.index', compact('instruments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Instrument::getTypes();
        $conditions = Instrument::getConditions();
        $categories = Category::all();

        return view('instruments.create', compact('types', 'conditions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'brand' => 'required|max:255',
            'year_acquired' => 'required|integer|min:1900|max:' . date('Y'),
            'purchase_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'condition' => 'required|max:255',
            'is_favorite' => 'sometimes',
            'categories' => 'nullable|array',
        ]);

        $data['is_favorite'] = $request->has('is_favorite');
        $data['user_id'] = 1; // For now, assign to test user

        $instrument = Instrument::create($data);

        if (isset($request->categories)) {
            $instrument->categories()->sync($request->categories);
        }

        return redirect()->route('instruments.index')
            ->with('success', 'New instrument added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instrument $instrument)
    {
        return view('instruments.show', compact('instrument'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instrument $instrument)
    {
        $types = Instrument::getTypes();
        $conditions = Instrument::getConditions();
        $categories = Category::all();

        return view('instruments.edit', compact('instrument', 'types', 'conditions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instrument $instrument)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'brand' => 'required|max:255',
            'year_acquired' => 'required|integer|min:1900|max:' . date('Y'),
            'purchase_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'condition' => 'required|max:255',
            'is_favorite' => 'sometimes',
            'categories' => 'nullable|array',
        ]);

        $data['is_favorite'] = $request->has('is_favorite');

        $instrument->update($data);

        if (isset($request->categories)) {
            $instrument->categories()->sync($request->categories);
        } else {
            $instrument->categories()->detach();
        }

        return redirect()->route('instruments.index')
            ->with('success', 'Instrument updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instrument $instrument)
    {
        $instrument->delete();

        return redirect()->route('instruments.index')
            ->with('success', 'Instrument removed from your collection');
    }
}
