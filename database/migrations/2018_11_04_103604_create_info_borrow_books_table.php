<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoBorrowBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_borrow_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soPhieuMuon')->unsigned();
            $table->integer('maSoSach')->unsigned();
            $table->integer('soLuong');
            $table->date('hanTra');
            $table->integer('trangThai');
            $table->foreign('soPhieuMuon')->references('id')->on('borrow_books');
            $table->foreign('maSoSach')->references('id')->on('books');
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
        Schema::dropIfExists('info_borrow_books');
    }
}
