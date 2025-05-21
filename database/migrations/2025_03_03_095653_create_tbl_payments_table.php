<?php

// 2025_03_03_000007_create_payments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_course');
            $table->unsignedBigInteger('id_user');
            $table->enum('payment_method', ['vn_pay', 'banking']);
            $table->double('amount');
            $table->text('content');
            $table->enum('status', ['waiting', 'success', 'canceled'])->default('waiting');
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
        Schema::dropIfExists('tbl_payments');
    }
};