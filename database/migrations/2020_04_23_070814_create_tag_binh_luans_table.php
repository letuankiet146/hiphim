<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagBinhLuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_binh_luans', function (Blueprint $table) {
            $table->string('phims_id');
            $table->string('binh_luans_id');
            $table->timestamps();
            $table->primary(['phims_id','binh_luans_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_binh_luans');
    }
}
