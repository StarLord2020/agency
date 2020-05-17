<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->string('company','50');
            $table->string('description');
            $table->string('position','100');
            $table->string('address');
            $table->decimal('salary');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('specialty_id');
            $table->timestamp('publication_date')->nullable();
            $table->timestamps();
        });
        Schema::table('bids', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('specialty_id')
                ->references('id')
                ->on('specialties')
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
        Schema::dropIfExists('bid');
    }
}
