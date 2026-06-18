<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function location()
    {
        $locations = Location::with('transactions')->get();
        
        foreach ($locations as $loc) {
            $loc->total_transactions = $loc->transactions()->count();
            $loc->total_income = $loc->transactions()->sum('total_bayar');
        }
        
        return view('reports.location', compact('locations'));
    }

    public function transaction()
    {
        $transactions = Transaction::with(['location', 'vehicleType'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalTransactions = count($transactions);
        $totalIncome = $transactions->sum('total_bayar');
        
        return view('reports.transaction', compact('transactions', 'totalTransactions', 'totalIncome'));
    }
}
