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
            $table->integer('phims_id');
            $table->integer('tap');
            $table->longText('url',2083);
            $table->longText('fb_url',2083);
            $table->timestamps();
            $table->primary(['phims_id','tap']);
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
