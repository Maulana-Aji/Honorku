<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kps', function (Blueprint $table) {
            $table->char('nip_kps',16)->primary();
            $table->string('nama_kps');
            $table->string('password');
            $table->string('alamat_kps');
            $table->tinyInteger('jk_kps');
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
        Schema::dropIfExists('kps');
    }
}
