<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailtransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailtransaksi', function (Blueprint $table) {
            $table->bigIncrements('id_detail_transaksi');
            $table->decimal("harga", 15);
            $table->decimal("berat", 15);
            $table->string("id_transaksi", 25);
            $table->string("id_harga_laundry", 25);
            $table->softDeletes();
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
        Schema::dropIfExists('detailtransaksi');
    }
}
