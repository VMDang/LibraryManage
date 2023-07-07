<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_books', function (Blueprint $table) {
            $table->id();
            $table->integer('borrow_id');
            $table->date('date_return')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 is normal , 0 is broken ');
            $table->tinyInteger('approve_status')->default(0)->comment('1 is approved  , 0 is not approved yet ');
            $table->integer('approved_by')->nullable();
            $table->string('message_user')->nullable();
            $table->string('message_mod')->nullable();
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
        Schema::dropIfExists('return_books');
    }
}
