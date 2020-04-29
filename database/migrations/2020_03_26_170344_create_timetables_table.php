<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('lesson');
            $table->enum('day',['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота']);
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('subject_user_id');
            $table->unsignedBigInteger('classroom_id');
            $table->enum('semester',['1','2']);
            $table->timestamps();
        });
        Schema::table('timetables',function (Blueprint $table){
            $table->foreign('grade_id')
                ->references('id')->on('grades')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('subject_user_id')
                ->references('id')->on('subject_user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('classroom_id')
                ->references('id')->on('classrooms')
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
        Schema::dropIfExists('timetables');
    }
}
