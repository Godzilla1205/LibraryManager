<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soPhieuMuon');
            $table->integer('maSoDG')->unsigned();
            $table->integer('maSoNV')->unsigned();
            $table->date('ngayMuon');
            $table->foreign('maSoDG')->references('id')->on('readers');
            $table->foreign('maSoNV')->references('id')->on('employees');
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
        Schema::dropIfExists('borrow_books');
    }
}
