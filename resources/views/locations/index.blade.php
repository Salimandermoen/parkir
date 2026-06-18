@extends('layouts.app')

@section('title', 'Location')
@section('page_name', 'Location')

@section('header_action')
    <a href="{{ route('locations.create') }}" class="btn-primary" style="text-decoration: none;">+ ADD NEW LOCATION</a>
@endsection

@section('content')
<div class="card">
    <h6 style="color: #cb0c9f; font-weight: 700; margin-bottom: 1.5rem;">Location <span style="font-weight: 400; color: #67748e;">Data Table</span></h6>
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>LOCATION NAME</th>
                    <th>MAX MOTORCYCLE</th>
                    <th>MAX CAR</th>
                    <th>MAX TRUCK/BUS/OTHER</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locations as $index => $location)
                <tr>
                    <td>
                        {{ $index + 1 }} &nbsp;&nbsp;&nbsp;
                        <a href="{{ route('locations.edit', $location->id) }}" style="color: #172b4d; text-decoration: none; font-size: 0.75rem; font-weight: 600;">
                            <i class="fas fa-pencil-alt" style="color: #11cdef; margin-right: 4px;"></i> EDIT
                        </a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display: inline-block; margin-left: 0.75rem;" onsubmit="return confirm('Are you sure you want to delete this location?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #f5365c; cursor: pointer; padding: 0; font-size: 0.75rem; font-weight: 600;">
                                <i class="fas fa-trash" style="margin-right: 4px;"></i> DELETE
                            </button>
                        </form>
                    </td>
                    <td><span style="font-weight: 600;">{{ $location->location_name }}</span></td>
                    <td>{{ $location->max_motorcycle }}</td>
                    <td>{{ $location->max_car }}</td>
                    <td>{{ $location->max_other }}</td>
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
