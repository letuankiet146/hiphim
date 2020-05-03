<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagDienViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_dien_viens', function (Blueprint $table) {
            $table->string('phims_id');
            $table->string('dien_viens_id');
            $table->timestamps();
            $table->primary(['phims_id','dien_viens_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_dien_viens');
    }
}
