<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            $table->decimal("total",15);
            $table->decimal("berat",15);
            $table->string("latitude_cust", 100);
            $table->string("longitude_cust", 100);
            $table->string("latitude_laundry", 100);
            $table->string("longitude_laundry", 100);
            $table->string("id_pengguna", 25);
            $table->string("id_status", 25);
            $table->string("id_layanan", 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
