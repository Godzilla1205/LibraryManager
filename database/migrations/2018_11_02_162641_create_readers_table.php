<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('maSoDG',50);
            $table->integer('idKhoa')->unsigned();
            $table->string('hoTenDG',100);
            $table->string('diaChiDG',100)->nullable();
            $table->date('ngaySinh')->nullable();
            $table->string('email',100)->nullable();
            $table->boolean('gioiTinh')->nullable();
            $table->date('ngayCap')->nullable();
            $table->date('hansuDung')->nullable();
            $table->foreign('idKhoa')->references('id')->on('faculties');
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
        Schema::dropIfExists('readers');
    }
}
