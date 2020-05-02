<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_offer', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->string('contacts');
            $table->string('address');
            $table->string('skills');
            $table->string('specialty');
            $table->string('experience');
            $table->string('education');
            $table->unsignedBigInteger('bid_id');
            $table->unsignedBigInteger('resume_id');
            $table->timestamps();
        });

        Schema::table('bid_offer', function (Blueprint $table) {
            $table->foreign('bid_id')
                ->references('id')
                ->on('bids')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('bid_offer');
    }
}
