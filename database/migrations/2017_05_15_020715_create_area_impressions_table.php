<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAreaImpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_impressions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_area_id')->default(0);
            $table->bigInteger('campaign_id')->default(0);
            $table->decimal('total_impression')->default(0);
            $table->decimal('total_cost')->default(0);
            $table->date('date')->nullable();

            $table->timestamps();

        });

        $this->updateTimestampDefaultValue('area_impressions', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_impressions');
    }
}
