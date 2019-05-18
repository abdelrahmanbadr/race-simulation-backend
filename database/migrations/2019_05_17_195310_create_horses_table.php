<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('speed');
            $table->float('strength');
            $table->float('endurance');
            $table->float('speed_shortage');
            $table->float('time_to_finish')->index()->nullable();
            $table->unsignedBigInteger('race_id');
            $table->foreign('race_id')->references('id')->on('horse_races');
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
        Schema::dropIfExists('horses');
    }
}
