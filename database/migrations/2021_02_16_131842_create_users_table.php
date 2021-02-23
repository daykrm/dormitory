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
            $table->string('name')->nullable();
            $table->foreignId('prefix_id')->nullable()->constrained('prefixes');
            $table->string('nickname')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('enrolled_year')->nullable();
            $table->foreignId('dorm_detail_id')->nullable()->constrained('dormitory_details');
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('faculty_id')->nullable()->constrained('faculties');
            $table->foreignId('type_id')->default(1)->constrained('user_types');
            $table->float('credit')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
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
