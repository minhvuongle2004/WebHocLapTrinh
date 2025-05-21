<?php
// 2025_03_03_000001_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 200);
            $table->string('displayname', 150);
            $table->string('username', 200)->unique();
            $table->string('email', 200)->unique();
            $table->string('password', 200);
            $table->string('device_id')->nullable();
            $table->string('phone', 12)->nullable();
            $table->text('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
};