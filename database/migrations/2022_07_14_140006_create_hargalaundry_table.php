<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargalaundryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hargalaundry', function (Blueprint $table) {
            $table->bigIncrements('id_harga_laundry');
            $table->decimal("harga", 15);
            $table->string("id_barang");
            $table->string("id_jenis_cuci");
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
        Schema::dropIfExists('hargalaundry');
    }
}
