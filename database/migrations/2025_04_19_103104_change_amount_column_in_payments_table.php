<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tbl_payments', function (Blueprint $table) {
            // Thêm cột transaction_code
            $table->string('transaction_code')->unique()->nullable()->after('id');
            // Thêm các cột cho VNPay
            $table->string('vnp_transaction_no')->nullable()->after('amount');
            $table->string('vnp_response_code')->nullable()->after('vnp_transaction_no');
            $table->string('vnp_bank_code')->nullable()->after('vnp_response_code');
            // Đổi amount thành decimal(10,2)
            $table->decimal('amount', 10, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('tbl_payments', function (Blueprint $table) {
            $table->dropColumn([
                'transaction_code',
                'vnp_transaction_no',
                'vnp_response_code',
                'vnp_bank_code'
            ]);
            $table->double('amount')->change();
        });
    }
};