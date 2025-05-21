<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // course_created, payment_success, message_received, course_enrolled
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('image')->nullable();
            $table->string('link');
            $table->unsignedBigInteger('source_id')->nullable(); // ID của đối tượng nguồn (course_id, payment_id, v.v.)
            $table->string('source_type')->nullable(); // Model class của đối tượng nguồn
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
