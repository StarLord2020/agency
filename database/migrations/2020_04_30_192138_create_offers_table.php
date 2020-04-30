<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->string('contacts');
            $table->string('experience');
            $table->string('description');
            $table->unsignedBigInteger('resume_id');
            $table->timestamps();
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('resume_id')
                ->references('id')
                ->on('resumes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
