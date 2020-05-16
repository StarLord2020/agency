<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bid_id');
            $table->enum('status',['Отказано','В рассмотрении','Принято']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('resume_id');
            $table->timestamps();
        });

        Schema::table('bid_offers', function (Blueprint $table) {
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
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('bid_offers');
    }
}
