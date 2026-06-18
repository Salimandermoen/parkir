@extends('layouts.app')

@section('title', 'Location Report')
@section('page_name', 'Location Report')

@section('content')
<div class="card">
    <h6 style="color: #cb0c9f; font-weight: 700; margin-bottom: 1.5rem;">Location Report <span style="font-weight: 400; color: #67748e;">Data Table</span></h6>
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>LOCATION NAME</th>
                    <th>MAX MOTORCYCLE</th>
                    <th>MAX CAR</th>
                    <th>MAX TRUCK/BUS/OTHER</th>
                    <th>TOTAL TRANSACTIONS</th>
                    <th>TOTAL INCOME</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locations as $index => $location)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span style="font-weight: 600;">{{ $location->location_name }}</span></td>
                    <td>{{ $location->max_motorcycle }}</td>
                    <td>{{ $location->max_car }}</td>
                    <td>{{ $location->max_other }}</td>
                    <td>{{ $location->total_transactions }}</td>
                    <td>Rp {{ number_format($location->total_income, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #67748e;">No data available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
