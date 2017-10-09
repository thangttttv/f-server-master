<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAreaWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_weights', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('area_id');
            $table->integer('day_of_week')->default(1);//1=mon, tue, web ... sun=7
            $table->integer('start_time')->default(0);//in minutes
            $table->integer('end_time')->default(0);//in minutes
            $table->float('weight')->default(0);

            $table->timestamps();

            $table->index(['area_id']);
        });

        $this->updateTimestampDefaultValue('area_weights', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_weights');
    }
}
