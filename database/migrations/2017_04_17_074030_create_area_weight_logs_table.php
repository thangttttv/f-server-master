<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAreaWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_weight_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('area_id');
            $table->integer('day_of_week')->default(1);//1=mon, tue, web ... sun=7
            $table->integer('start_time')->default(0);//in minutes
            $table->integer('end_time')->default(0);//in minutes
            $table->float('weight')->default(0);
            $table->timestamp('active_to');

            $table->timestamps();

            $table->index(['area_id']);
        });

        $this->updateTimestampDefaultValue('area_weight_logs', ['updated_at'], ['created_at', 'active_to']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_weight_logs');
    }
}
