<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->String('book_code')->nullable();
            $table->String('title')->unique();
            $table->String('author');
            $table->String('price_code')->nullable();
            $table->double('price',10,2)->default(0);
            $table->Integer('quantity')->default(0);
            $table->String('status')->nullable();
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
        Schema::dropIfExists('boooks');
    }
}
