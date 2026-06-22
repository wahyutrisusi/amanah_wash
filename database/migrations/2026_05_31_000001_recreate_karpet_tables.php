<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old tables if they exist (fresh start)
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('pemesanans');
        Schema::dropIfExists('layanans');

        // Layanans — jenis layanan cuci karpet
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_karpet', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pemesanans — pesanan cuci karpet
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('restrict');
            $table->string('nama');
            $table->string('telepon', 20);
            $table->text('alamat')->nullable();
            $table->unsignedSmallInteger('jumlah_karpet')->default(1);
            $table->text('catatan')->nullable();
            $table->string('nomor_antrian', 10)->nullable();
            $table->enum('status', ['menunggu', 'dicuci', 'dijemur', 'selesai', 'diambil'])
                  ->default('menunggu');
            $table->date('tanggal_masuk');
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });

        // Pembayarans — transaksi pembayaran
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->onDelete('cascade');
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->enum('status_pembayaran', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->string('metode_pembayaran')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('pemesanans');
        Schema::dropIfExists('layanans');
    }
};
