<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('view_count')->default(1);
            $table->timestamp('last_viewed_at')->default(now());

            $table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('tbl_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_views');
    }
};
