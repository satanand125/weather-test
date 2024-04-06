<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('coordinates');
            $table->string('weather_condition');
            $table->decimal('temperature', 8, 2);
            $table->decimal('feels_like', 8, 2);
            $table->integer('humidity');
            $table->decimal('wind_speed', 8, 2);
            $table->timestamps();

            // $table->foreign('city')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
