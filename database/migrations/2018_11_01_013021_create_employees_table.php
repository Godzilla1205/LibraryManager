<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->char('maSoNV',50);
            $table->string('hoTenNV',100);
            $table->string('diaChiNV',100)->nullable();
            $table->date('ngaySinhNV')->nullable();
            $table->boolean('gioiTinhNV')->nullable();
            $table->integer('soDTNV')->nullable();
            $table->string('emailNV',200)->nullable();
            $table->date('ngayVaoLam')->nullable();
            $table->string('avatar',500)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
