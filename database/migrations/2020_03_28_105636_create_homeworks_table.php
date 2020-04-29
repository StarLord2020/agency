<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_user_id');
            $table->unsignedBigInteger('grade_id');
            $table->string('name');
            $table->string('lesson');
            $table->enum('semester',['1','2']);
            $table->string('day');
            $table->string('description');
            $table->timestamp('deadline');
            $table->timestamps();
        });
        Schema::table('homeworks', function (Blueprint $table) {
            $table->foreign('subject_user_id')
                ->references('id')
                ->on('subject_user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
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
        Schema::dropIfExists('homework');
    }
}
