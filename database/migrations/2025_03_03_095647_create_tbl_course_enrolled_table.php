<?php

// 2025_03_03_000006_create_course_enrolled_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_course_enrolled', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_course');
            $table->text('title_course');
            $table->enum('status', ['completed', 'in_progess', 'expired'])->default('in_progess');
            $table->float('progess')->default(0);
            $table->dateTime('expiration_date');
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id')
                  ->on('tbl_users')
                  ->onDelete('cascade');

            $table->foreign('id_course')
                  ->references('id')
                  ->on('tbl_courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_course_enrolled');
    }
};