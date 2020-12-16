<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoTableChiTietHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietHoaDon', function (Blueprint $table) {
            $table->increments('Id_CT');
            $table->string('Ten_SP',30);
            $table->double('So_Luong',8,2);
            $table->Integer('Id_SP');
            $table->Integer('Id_HD');
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
        Schema::dropIfExists('ChiTietHoaDon');
    }
}
