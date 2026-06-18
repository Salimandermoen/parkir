@extends('layouts.app')

@section('title', 'Add Location')
@section('page_name', 'Location')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <h6 style="color: #cb0c9f; font-weight: 700; margin-bottom: 2rem;">Location <span style="font-weight: 400; color: #67748e;">Input Form</span></h6>
    
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1.5rem;">
            <label for="location_name" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Location Name</label>
            <input type="text" id="location_name" name="location_name" placeholder="Gedung A" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('location_name')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="max_motorcycle" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Max Motorcycle</label>
            <input type="number" id="max_motorcycle" name="max_motorcycle" placeholder="0" value="0" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('max_motorcycle')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="max_car" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Max Car</label>
            <input type="number" id="max_car" name="max_car" placeholder="0" value="0" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('max_car')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 2rem;">
            <label for="max_other" style="display: block; font-size: 0.75rem; font-weight: 700; color: #344767; margin-bottom: 0.5rem; text-transform: uppercase;">Max Truck/Bus/Other</label>
            <input type="number" id="max_other" name="max_other" placeholder="0" value="0" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d2d6da; border-radius: 0.5rem; outline: none; font-size: 0.875rem; color: #495057;">
            @error('max_other')
                <span style="font-size: 0.75rem; color: #ea0606; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('locations.index') }}" style="flex: 1; text-align: center; background-color: #172b4d; border: none; border-radius: 0.5rem; color: #fff; padding: 0.75rem 1.5rem; text-decoration: none; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; display: flex; align-items: center; justify-content: center;">CANCEL</a>
            <button type="submit" style="flex: 1; background: linear-gradient(310deg, #7928ca 0%, #ff0080 100%); border: none; border-radius: 0.5rem; color: #fff; padding: 0.75rem 1.5rem; cursor: pointer; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">SAVE LOCATION</button>
        </div>
    </form>
</div>
@endsection
