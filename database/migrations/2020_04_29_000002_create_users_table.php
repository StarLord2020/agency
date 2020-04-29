<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('FIO');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('number',20)->nullable();
            $table->string('address');
            $table->string('birthday');
            $table->enum('sex',['Мужчина','Женщина']);
            $table->unsignedBigInteger('role_id');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::dropIfExists('user');
    }
}
