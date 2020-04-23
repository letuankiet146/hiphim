<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phims', function (Blueprint $table) {
            $table->id();
            $table->string('tenphim');
            $table->integer('danhmucs_id');
            $table->longText('url',2083);
            $table->longText('fb',2083);
            $table->integer('luotxem');
            $table->decimal('imdb',2,1);
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
        Schema::dropIfExists('phims');
    }
}
