<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('preview_content')->nullable();
            $table->string('file_book', 255)->nullable();
            $table->string('author', 255);
            $table->string('publisher', 255)->nullable();
            $table->date('date_publication')->nullable();
            $table->integer('cost')->default(0);
            $table->tinyInteger('number', false, true)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('books');
    }
}
