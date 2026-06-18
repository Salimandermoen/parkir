@extends('layouts.app')

@section('title', 'Edit Vehicle Type')
@section('page_name', 'Vehicle Type')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h6 style="color: #cb0c9f; font-weight: 700; margin: 0;">Vehicle Type <span style="font-weight: 400; color: #67748e;">Edit Form</span></h6>
        <form action="{{ route('vehicle_types.destroy', $vehicleType->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle type?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="background-color: #ea0606; border: none; border-radius: 0.5rem; color: #fff; padding: 0.5rem 1rem; cursor: pointer; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">DELETE VEHICLE TYPE</button>
        </form>
    </div>
    
    <form action="{{ route('vehicle_types.update', $vehicleType->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label for="jenis" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Vehicle Type</label>
            <select id="jenis" name="jenis" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057; background-color: #fff;">
                <option value="motorcycle" {{ old('jenis', $vehicleType->jenis) == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                <option value="car" {{ old('jenis', $vehicleType->jenis) == 'car' ? 'selected' : '' }}>Car</option>
                <option value="other" {{ old('jenis', $vehicleType->jenis) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('jenis')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="perjam_pertama" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">First Hour Charges</label>
            <input type="number" id="perjam_pertama" name="perjam_pertama" value="{{ old('perjam_pertama', $vehicleType->perjam_pertama) }}" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('perjam_pertama')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="perjam_berikutnya" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Next Hourly Charges</label>
            <input type="number" id="perjam_berikutnya" name="perjam_berikutnya" value="{{ old('perjam_berikutnya', $vehicleType->perjam_berikutnya) }}" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('perjam_berikutnya')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 2rem;">
            <label for="max_perhari" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Max Cost Per Day</label>
            <input type="number" id="max_perhari" name="max_perhari" value="{{ old('max_perhari', $vehicleType->max_perhari) }}" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('max_perhari')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('vehicle_types.index') }}" style="flex: 1; text-align: center; background-color: #172b4d; border: none; border-radius: 0.5rem; color: #fff; padding: 0.75rem 1.5rem; text-decoration: none; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; display: flex; align-items: center; justify-content: center;">CANCEL</a>
            <button type="submit" style="flex: 1; background: linear-gradient(310deg, #7928ca 0%, #ff0080 100%); border: none; border-radius: 0.5rem; color: #fff; padding: 0.75rem 1.5rem; cursor: pointer; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">SAVE VEHICLE TYPE</button>
        </div>
    </form>
</div>
@endsection
