<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoTapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_taps', function (Blueprint $table) {
            $table->id();
            $table->integer('tap');
            $table->longText('jwurl',2083);
            $table->longText('url',2083);
            $table->smallInteger('thoiluong')->nullable();
            $table->date('ngaytao');
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
        Schema::dropIfExists('so_taps');
    }
}
