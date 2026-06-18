@extends('layouts.app')

@section('title', 'Vehicle Type')
@section('page_name', 'Vehicle Type')

@section('header_action')
    <a href="{{ route('vehicle_types.create') }}" class="btn-primary" style="text-decoration: none;">+ ADD NEW VEHICLE TYPE</a>
@endsection

@section('content')
<div class="card">
    <h6 style="color: #cb0c9f; font-weight: 700; margin-bottom: 1.5rem;">Vehicle Type <span style="font-weight: 400; color: #67748e;">Data Table</span></h6>
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>VEHICLE TYPE</th>
                    <th>FIRST HOUR CHARGES</th>
                    <th>NEXT HOURLY CHARGES</th>
                    <th>MAX COST PER DAY</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicleTypes as $index => $type)
                <tr>
                    <td>
                        {{ $index + 1 }} &nbsp;&nbsp;&nbsp;
                        <a href="{{ route('vehicle_types.edit', $type->id) }}" style="color: #172b4d; text-decoration: none; font-size: 0.75rem; font-weight: 600;">
                            <i class="fas fa-pencil-alt" style="color: #11cdef; margin-right: 4px;"></i> EDIT
                        </a>
                        <form action="{{ route('vehicle_types.destroy', $type->id) }}" method="POST" style="display: inline-block; margin-left: 0.75rem;" onsubmit="return confirm('Are you sure you want to delete this vehicle type?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #f5365c; cursor: pointer; padding: 0; font-size: 0.75rem; font-weight: 600;">
                                <i class="fas fa-trash" style="margin-right: 4px;"></i> DELETE
                            </button>
                        </form>
                    </td>
                    <td><span style="font-weight: 600;">{{ ucfirst($type->jenis) }}</span></td>
                    <td>Rp {{ number_format($type->perjam_pertama, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($type->perjam_berikutnya, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($type->max_perhari, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #67748e;">No data available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
