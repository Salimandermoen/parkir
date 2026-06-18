@extends('layouts.app')

@section('title', 'All Transactions')
@section('page_name', 'All Transactions')

@section('content')
<div class="card">
    <h6 style="color: #cb0c9f; font-weight: 700; margin-bottom: 1.5rem;">All Transactions <span style="font-weight: 400; color: #67748e;">Data Table</span></h6>
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TICKET NUMBER</th>
                    <th>POLICE NUMBER</th>
                    <th>LOCATION NAME</th>
                    <th>VEHICLE TYPE</th>
                    <th>TIME IN</th>
                    <th>TIME OUT</th>
                    <th>FIRST HOUR CHARGES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $tx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ route('transactions.ticket', $tx->id) }}" target="_blank" style="color: #ea0606; text-decoration: none; font-size: 0.75rem; font-weight: 600;">
                            <i class="fas fa-file-pdf"></i> {{ $tx->no_tiket }}
                        </a>
                    </td>
                    <td><span style="font-weight: 600;">{{ $tx->no_polisi }}</span></td>
                    <td>{{ $tx->location->location_name }}</td>
                    <td>{{ ucfirst($tx->vehicleType->jenis) }}</td>
                    <td>{{ $tx->masuk }}</td>
                    <td>{{ $tx->keluar ?? '-' }}</td>
                    <td>Rp {{ number_format($tx->perjam_pertama, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #67748e;">No transactions available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card" style="margin-top: 1.5rem;">
    <h6 style="color: #cb0c9f; font-weight: 700; margin-bottom: 1.5rem;">Transaction Details</h6>
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>TIME IN</th>
                    <th>TIME OUT</th>
                    <th>FIRST HOUR CHARGES</th>
                    <th>NEXT HOURLY CHARGES</th>
                    <th>MAX COST PER DAY</th>
                    <th>TOTAL HOURS</th>
                    <th>TOTAL DAYS</th>
                    <th>TOTAL PAYS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $tx)
                <tr>
                    <td>{{ $tx->masuk }}</td>
                    <td>{{ $tx->keluar ?? '-' }}</td>
                    <td>Rp {{ number_format($tx->perjam_pertama, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($tx->perjam_berikutnya, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($tx->max_perhari, 0, ',', '.') }}</td>
                    <td>{{ $tx->total_jam ?? '-' }}</td>
                    <td>{{ $tx->total_jam ? floor($tx->total_jam / 24) : '-' }}</td>
                    <td>Rp {{ number_format($tx->total_bayar ?? 0, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #67748e;">No transactions available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
