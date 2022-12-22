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
            $table->integer('role_id')->default(3);
            $table->string('name', 255);
            $table->string('image', 255);
            $table->tinyInteger('gender');
            $table->date('birthday');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('1 is exist, 0 is deleted');
            $table->integer('deleted_by')->nullable();
            $table->integer('updated_role_by')->nullable();
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
