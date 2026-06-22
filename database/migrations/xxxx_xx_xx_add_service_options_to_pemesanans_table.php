<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceOptionsToPemesanansTable extends Migration
{
    public function up()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->boolean('cuci_karpet')->default(false);
            $table->enum('metode_pengambilan', ['jemput', 'datang'])->default('datang');
            $table->enum('metode_pengembalian', ['antar', 'ambil'])->default('ambil');
            $table->boolean('notifikasi_wa')->default(true);
            $table->enum('status_pengerjaan', [
                'menunggu_konfirmasi',
                'menunggu_penjemputan',
                'dalam_perjalanan',
                'sedang_dicuci',
                'selesai_dicuci',
                'dalam_pengantaran',
                'selesai'
            ])->default('menunggu_konfirmasi');
            $table->timestamp('estimasi_selesai')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn([
                'cuci_karpet',
                'metode_pengambilan',
                'metode_pengembalian',
                'notifikasi_wa',
                'status_pengerjaan',
                'estimasi_selesai'
            ]);
        });
    }
} 