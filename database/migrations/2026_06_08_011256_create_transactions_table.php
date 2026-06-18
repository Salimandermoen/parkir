<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lokasi')->constrained('locations');
            $table->string('no_tiket', 255);
            $table->string('no_polisi', 15);
            $table->foreignId('id_jenis')->constrained('vehicle_types');
            $table->dateTime('masuk');
            $table->dateTime('keluar')->nullable();
            $table->integer('perjam_pertama');
            $table->integer('perjam_berikutnya');
            $table->integer('max_perhari');
            $table->integer('total_jam')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
