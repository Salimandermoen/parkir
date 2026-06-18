<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:100',
            'max_motorcycle' => 'required|integer|min:0',
            'max_car' => 'required|integer|min:0',
            'max_other' => 'required|integer|min:0',
        ]);

        Location::create($validated);

        return redirect()->route('locations.index')
            ->with('success', 'New Location was successfully saved!');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:100',
            'max_motorcycle' => 'required|integer|min:0',
            'max_car' => 'required|integer|min:0',
            'max_other' => 'required|integer|min:0',
        ]);

        $location->update($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location was successfully updated!');
    }

    public function destroy(Location $location)
    {
        try {
            $location->delete();
        } catch (QueryException $e) {
            return redirect()->route('locations.index')
                ->with('error', 'Location cannot be deleted because it is already used in transactions.');
        }

        return redirect()->route('locations.index')
            ->with('success', 'Location was successfully deleted!');
    }
}
