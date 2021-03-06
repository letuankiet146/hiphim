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
            $table->string('link_id');
            $table->string('tenphim');
            $table->string('tenphim_en');
            $table->smallInteger('nam')->nullable();

            $table->boolean('phude')->default(0);
            $table->boolean('sapchieu')->default(0);
            $table->smallInteger('thoiluong');

            $table->string('poster');
            $table->string('background');
            $table->string('phude');

            $table->longText('meta_desc',2083);
            $table->longText('mota',2083);
            $table->integer('danhmucs_id');
            $table->integer('tongsotap')->nullable();
            $table->integer('sotaps_id');
            $table->integer('quocgias_id');
            $table->longText('url',2083);
            $table->longText('original_url',2083);
            $table->longText('trailer',2083);
            $table->integer('luotxem')->default(0);
            $table->decimal('imdb',2,1)->nullable();
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
