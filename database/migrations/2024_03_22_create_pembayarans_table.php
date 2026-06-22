<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanans');
            $table->decimal('jumlah', 10, 2);
            $table->string('metode_pembayaran');
            $table->string('channel_pembayaran')->nullable();
            $table->string('nomor_virtual_account')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}; 