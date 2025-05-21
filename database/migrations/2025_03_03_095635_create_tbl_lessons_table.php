<?php

// 2025_03_03_000004_create_lessons_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_lessons', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->unsignedBigInteger('id_course');
            $table->text('url');
            $table->boolean('is_preview')->default(false);
            $table->string('time', 20);
            $table->text('chapter');
            $table->timestamps();

            $table->foreign('id_course')
                  ->references('id')
                  ->on('tbl_courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_lessons');
    }
};