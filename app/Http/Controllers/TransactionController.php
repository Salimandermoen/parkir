<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\VehicleType;
use App\Models\Transaction;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::all();
        $vehicleTypes = VehicleType::all();
        
        
        foreach ($locations as $loc) {
            $activeMotorcycles = $loc->transactions()
                ->whereNull('keluar')
                ->whereHas('vehicleType', function($q) {
                    $q->where('jenis', 'motorcycle');
                })
                ->count();
            $loc->available_motorcycle = max(0, $loc->max_motorcycle - $activeMotorcycles);

            $activeCars = $loc->transactions()
                ->whereNull('keluar')
                ->whereHas('vehicleType', function($q) {
                    $q->where('jenis', 'car');
                })
                ->count();
            $loc->available_car = max(0, $loc->max_car - $activeCars);

            $activeOthers = $loc->transactions()
                ->whereNull('keluar')
                ->whereHas('vehicleType', function($q) {
                    $q->where('jenis', 'other');
                })
                ->count();
            $loc->available_other = max(0, $loc->max_other - $activeOthers);
        }

      
        $recentTransactions = Transaction::with(['location', 'vehicleType'])
            ->whereNull('keluar')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('transactions.index', compact('locations', 'vehicleTypes', 'recentTransactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lokasi' => 'required|exists:locations,id',
            'id_jenis' => 'required|exists:vehicle_types,id',
            'no_polisi' => 'required|string|max:15',
        ]);

        $location = Location::findOrFail($request->id_lokasi);
        $vehicleType = VehicleType::findOrFail($request->id_jenis);

     
        $activeCount = Transaction::where('id_lokasi', $location->id)
            ->whereNull('keluar')
            ->where('id_jenis', $vehicleType->id)
            ->count();

        $maxCapacity = 0;
        if ($vehicleType->jenis == 'motorcycle') {
            $maxCapacity = $location->max_motorcycle;
        } elseif ($vehicleType->jenis == 'car') {
            $maxCapacity = $location->max_car;
        } elseif ($vehicleType->jenis == 'other') {
            $maxCapacity = $location->max_other;
        }

        if ($activeCount >= $maxCapacity) {
            return redirect()->back()->withErrors(['capacity' => 'Kapasitas parkir untuk jenis kendaraan ini di lokasi tersebut sudah penuh!']);
        }

       
        $no_tiket = date('YmdHis');
        
        
        while (Transaction::where('no_tiket', $no_tiket)->exists()) {
            sleep(1);
            $no_tiket = date('YmdHis');
        }

        Transaction::create([
            'id_lokasi' => $location->id,
            'no_tiket' => $no_tiket,
            'no_polisi' => strtoupper(str_replace(' ', '', $request->no_polisi)),
            'id_jenis' => $vehicleType->id,
            'masuk' => now(),
            'perjam_pertama' => $vehicleType->perjam_pertama,
            'perjam_berikutnya' => $vehicleType->perjam_berikutnya,
            'max_perhari' => $vehicleType->max_perhari,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Vehicle checked in successfully! Ticket #' . $no_tiket);
    }

    public function exit(Request $request)
    {
        $request->validate([
            'no_tiket' => 'required|string',
            'no_polisi' => 'required|string',
        ]);

        $no_polisi_clean = strtoupper(str_replace(' ', '', $request->no_polisi));

        $transaction = Transaction::where('no_tiket', $request->no_tiket)
            ->where('no_polisi', $no_polisi_clean)
            ->whereNull('keluar')
            ->first();

        if (!$transaction) {
            return redirect()->back()->withErrors(['exit_error' => 'Data tiket aktif tidak ditemukan atau nomor polisi tidak cocok.']);
        }

        $masuk = Carbon::parse($transaction->masuk);
        $keluar = now();
        $diffInSeconds = $masuk->diffInSeconds($keluar);
        
        // Calculate parking duration in minutes (1 menit = 1 jam untuk perhitungan)
        $minutes = max(1, (int) ceil($diffInSeconds / 60.0));

        $total = 0;
        if ($minutes <= 1440) {
            // Parkir 0-1440 menit (24 jam)
            $total = $transaction->perjam_pertama + $transaction->perjam_berikutnya * ($minutes - 1);
            
            if ($total > $transaction->max_perhari) {
                $total = $transaction->max_perhari;
            }
        } else {
            // Parkir > 1440 menit (> 24 jam) - hitung per hari dengan 60% dari max_perhari
            $days = (int) ceil($minutes / 1440);
            $total = $days * (0.60 * $transaction->max_perhari);
        }

        $transaction->update([
            'keluar' => $keluar,
            'total_jam' => $minutes,
            'total_bayar' => $total,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Vehicle checked out successfully! Total payment: Rp ' . number_format($total, 0, ',', '.'));
    }

    public function ticket(Transaction $transaction)
    {
        $pdf = Pdf::loadView('transactions.ticket', compact('transaction'))
            ->setPaper([0, 0, 226, 560], 'portrait');
        
        return $pdf->stream('ticket-' . $transaction->no_tiket . '.pdf');
    }

    public function allTransactions()
    {
        $transactions = Transaction::with(['location', 'vehicleType'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('transactions.all', compact('transactions'));
    }
}
