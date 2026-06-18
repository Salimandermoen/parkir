<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::all();
        return view('vehicle_types.index', compact('vehicleTypes'));
    }

    public function create()
    {
        return view('vehicle_types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:motorcycle,car,other',
            'perjam_pertama' => 'required|integer|min:0',
            'perjam_berikutnya' => 'required|integer|min:0',
            'max_perhari' => 'required|integer|min:0',
        ]);

        VehicleType::create($validated);

        return redirect()->route('vehicle_types.index')
            ->with('success', 'New Vehicle Type was successfully saved!');
    }

    public function edit(VehicleType $vehicleType)
    {
        return view('vehicle_types.edit', compact('vehicleType'));
    }

    public function update(Request $request, VehicleType $vehicleType)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:motorcycle,car,other',
            'perjam_pertama' => 'required|integer|min:0',
            'perjam_berikutnya' => 'required|integer|min:0',
            'max_perhari' => 'required|integer|min:0',
        ]);

        $vehicleType->update($validated);

        return redirect()->route('vehicle_types.index')
            ->with('success', 'Vehicle Type was successfully updated!');
    }

    public function destroy(VehicleType $vehicleType)
    {
        try {
            $vehicleType->delete();
        } catch (QueryException $e) {
            return redirect()->route('vehicle_types.index')
                ->with('error', 'Vehicle Type cannot be deleted because it is already used in transactions.');
        }

        return redirect()->route('vehicle_types.index')
            ->with('success', 'Vehicle Type was successfully deleted!');
    }
}
