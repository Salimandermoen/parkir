@extends('layouts.app')

@section('title', 'Transaction Report')
@section('page_name', 'Transaction Report')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h6 style="color: #cb0c9f; font-weight: 700; margin: 0;">Transaction Report <span style="font-weight: 400; color: #67748e;">Summary</span></h6>
        <div style="display: flex; gap: 1rem;">
            <div style="text-align: right;">
                <span style="font-size: 0.75rem; color: #67748e; font-weight: 600;">Total Transactions</span>
                <div style="font-size: 1.25rem; font-weight: 700; color: #344767;">{{ $totalTransactions }}</div>
            </div>
            <div style="text-align: right;">
                <span style="font-size: 0.75rem; color: #67748e; font-weight: 600;">Total Income</span>
                <div style="font-size: 1.25rem; font-weight: 700; color: #344767;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
    
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>TICKET NUMBER</th>
                    <th>POLICE NUMBER</th>
                    <th>LOCATION NAME</th>
                    <th>VEHICLE TYPE</th>
                    <th>TIME IN</th>
                    <th>TIME OUT</th>
                    <th>TOTAL HOURS</th>
                    <th>TOTAL DAYS</th>
                    <th>TOTAL PAYS</th>
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
                    <td>{{ $tx->total_jam ?? '-' }}</td>
                    <td>{{ $tx->total_jam ? floor($tx->total_jam / 24) : '-' }}</td>
                    <td>Rp {{ number_format($tx->total_bayar ?? 0, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align: center; color: #67748e;">No transactions available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
