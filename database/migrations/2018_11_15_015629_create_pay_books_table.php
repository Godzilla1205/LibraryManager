<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_books', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('soPhieuMuon')->unsigned();
            $table->integer('maSoSach')->unsigned();
            $table->integer('maSoNV')->unsigned();
            $table->date('ngayTra');
            $table->string('ghiChu',200)->nullable();
            $table->foreign('soPhieuMuon')->references('id')->on('borrow_books');
            $table->foreign('maSoSach')->references('id')->on('books');
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
        Schema::dropIfExists('pay_books');
    }
}
