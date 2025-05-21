<?php

// 2025_03_03_000009_create_incomes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('total_buyer');
            $table->decimal('total_amount', 10, 2);
            $table->enum('type', ['day', 'month']);
            $table->string('time', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_incomes');
    }
};