<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Taobangbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BinhLuan', function (Blueprint $table) {
            $table->increments('Id_BL');
            $table->string('Noi_Dung',255)->unique();
            $table->integer('ThuTu');
            $table->boolean("AnHien");
            $table->unsignedInteger("Id_KH");
            $table->unsignedInteger("Id_TT");
            $table->Integer('TT_TB')->null();
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
        Schema::dropIfExists('BinhLuan');
    }
}
