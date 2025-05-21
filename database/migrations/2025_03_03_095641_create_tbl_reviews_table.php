<?php

// 2025_03_03_000005_create_reviews_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_course');
            $table->text('content');
            $table->float('rate');
            $table->enum('status', ['removed', 'exist'])->default('exist');
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
        Schema::dropIfExists('tbl_reviews');
    }
};