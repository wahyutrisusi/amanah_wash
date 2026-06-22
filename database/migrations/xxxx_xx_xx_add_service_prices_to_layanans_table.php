<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicePricesToLayanansTable extends Migration
{
    public function up()
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->decimal('harga_karpet', 10, 2)->nullable();
            $table->decimal('biaya_jemput', 10, 2)->nullable();
            $table->decimal('biaya_antar', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn(['harga_karpet', 'biaya_jemput', 'biaya_antar']);
        });
    }
} 