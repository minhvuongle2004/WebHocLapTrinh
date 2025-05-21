<?php

// 2025_03_03_000003_create_courses_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('level', 50);
            $table->integer('lesson');
            $table->double('price');
            $table->unsignedBigInteger('category_id'); // Khóa ngoại
            $table->string('total_time_finish');
            $table->string('finish_time');
            $table->text('thumbnail');
            $table->integer('expiration_date');
            $table->text('list_chapter');
            $table->float('rate')->default(0);
            $table->integer('student_enrolled')->default(0);
            $table->enum('status', ['Complete', 'Uncomplete']);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('category_id')->references('id')->on('tbl_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_courses');
    }
};
