<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            // Unique constraint để đảm bảo người dùng không thêm trùng khóa học vào wishlist
            $table->unique(['user_id', 'course_id']);

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('tbl_courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_wishlists');
    }
};