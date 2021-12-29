<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->default('null');
            $table->string('mobile_num');
            $table->enum('status',['deactive', 'active'])->default('active');
            $table->enum('role',['1', '2'])->default('2');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['first_name' => "Developer", 'last_name' => "Admin", 'email' => "raj@gamil.com", 'password' => '$2y$10$KL45eyA1OIemui3m0EubbePzx4KSl5uulrl.2pS8tlzE6leMRri4u', 'mobile_num' => "9812263042", 'status' => "active", 'role' => "1" ],
           
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
