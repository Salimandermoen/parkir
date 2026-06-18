<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parking Ticket - {{ $transaction->no_tiket }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 24px 18px;
            text-align: center;
        }
        .ticket-wrapper {
            width: 100%;
        }
        .brand-name {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 2px;
            text-transform: uppercase;
        }
        .address {
            font-size: 14px;
            line-height: 1.25;
            margin: 0 auto 42px;
            max-width: 250px;
        }
        .ticket-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 14px;
            text-transform: uppercase;
        }
        .location-name,
        .vehicle-type {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.35;
        }
        .vehicle-type {
            margin-bottom: 30px;
        }
        .ticket-info {
            display: inline-block;
            text-align: left;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.45;
            margin-bottom: 36px;
        }
        .warning {
            font-size: 12px;
            font-weight: 700;
            line-height: 1.25;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="ticket-wrapper">
        <div class="brand-name">SIJA PARKING</div>
        <div class="address">
            Jl. Raya Karadenan No.7, Karadenan,<br>
            Kec. Cibinong, Kabupaten Bogor, Jawa<br>
            Barat 16111
        </div>

        <div class="ticket-title">TIKET PARKIR</div>
        <div class="location-name">{{ $transaction->location->location_name }}</div>
        <div class="vehicle-type">{{ ucfirst($transaction->vehicleType->jenis) }}</div>

        <div class="ticket-info">
            No Tiket : {{ $transaction->no_tiket }}<br>
            Tanggal : {{ $transaction->masuk }}
        </div>

        <div class="warning">
            Jangan meninggalkan tiket dan barang<br>
            berharga di dalam kendaraan
        </div>
    </div>
</body>
</html>
