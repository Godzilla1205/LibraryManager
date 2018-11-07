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
            $table->char('maSoSach',50);
            $table->integer('idNXB')->unsigned();
            $table->integer('idLoaiSach')->unsigned();
            $table->string('tenSach',100);
            $table->string('tacGia',100)->nullable();
            $table->integer('namXB')->nullable();
            $table->integer('lanXB')->default(0);
            $table->integer('soLuong')->default(0);
            $table->integer('giaTien')->default(0);
            $table->string('noiDungTomLuoc',500)->nullable();
            $table->string('linkAnh',100)->nullable();
            $table->foreign('idNXB')->references('id')->on('publishers');
            $table->foreign('idLoaiSach')->references('id')->on('type_books');
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
