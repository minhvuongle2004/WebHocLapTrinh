<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sender');
            $table->unsignedBigInteger('id_receiver');
            $table->enum('status', ['removed', 'exist'])->default('exist');
            $table->text('content');
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('id_sender')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_receiver')->references('id')->on('tbl_users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_messages');
    }
};
