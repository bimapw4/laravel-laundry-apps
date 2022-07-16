<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->bigIncrements('id_pengguna');
            $table->string("nama_lengkap", 50);
            $table->text("alamat")->nullable();
            $table->string("gender", 1);
            $table->string("telephone", 13);
            $table->string("email", 25);
            $table->text("password");
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
        Schema::dropIfExists('pengguna');
    }
}
