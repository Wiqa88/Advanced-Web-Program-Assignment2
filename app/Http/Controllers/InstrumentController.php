<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    /**
     * Constructor to require authentication
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all gear items for the authenticated user.
     */
    public function index(Request $request)
    {
        $gear = Instrument::query()->where('user_id', auth()->id());

        // Search feature
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $gear->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('brand', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Sort by name
        $gear->orderBy('name', 'asc');

        // Page through results
        $instruments = $gear->paginate(5);

        return view('instruments.index', compact('instruments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Make sure data is valid
        $data = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'brand' => 'required|max:255',
            'year_acquired' => 'required|integer|min:1900|max:' . date('Y'),
            'purchase_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'condition' => 'required|max:255',
            'is_favorite' => 'sometimes',
        ]);

        // Handle the checkbox
        $data['is_favorite'] = $request->has('is_favorite');

        // Add user_id to the data
        $data['user_id'] = auth()->id();

        // Save to database
        Instrument::create($data);

        return redirect()->route('instruments.index')
            ->with('success', 'New gear added!');
    }

    /**
     * Show gear details.
     */
    public function show(Instrument $instrument)
    {
        // Make sure the instrument belongs to the authenticated user
        $this->authorize('view', $instrument);

        return view('instruments.show', compact('instrument'));
    }

    /**
     * Show edit form.
     */
    public function edit(Instrument $instrument)
    {
        // Make sure the instrument belongs to the authenticated user
        $this->authorize('update', $instrument);

        $types = Instrument::getTypes();
        $conditions = Instrument::getConditions();

        return view('instruments.edit', compact('instrument', 'types', 'conditions'));
    }

    /**
     * Update gear in database.
     */
    public function update(Request $request, Instrument $instrument)
    {
        // Make sure the instrument belongs to the authenticated user
        $this->authorize('update', $instrument);

        // Check data is valid
        $data = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'brand' => 'required|max:255',
            'year_acquired' => 'required|integer|min:1900|max:' . date('Y'),
            'purchase_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'condition' => 'required|max:255',
            'is_favorite' => 'sometimes',
        ]);

        // Handle the checkbox
        $data['is_favorite'] = $request->has('is_favorite');

        // Update the database
        $instrument->update($data);

        return redirect()->route('instruments.index')
            ->with('success', 'Gear updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instrument $instrument)
    {
        // Make sure the instrument belongs to the authenticated user
        $this->authorize('delete', $instrument);

        $instrument->delete();

        return redirect()->route('instruments.index')
            ->with('success', 'Gear removed from your collection');
    }
}
