<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('maSoNXB',100);
            $table->string('hoTenNXB',100);
            $table->string('diaChiNXB',200)->nullable();
            $table->string('websiteNXB',200)->nullable();
            $table->string('thongTinKhacNXB',200)->nullable();
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
        Schema::dropIfExists('publishers');
    }
}
