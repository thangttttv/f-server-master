<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCampaignAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_areas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_id');
            $table->bigInteger('area_id');

            $table->timestamps();

            $table->index(['campaign_id']);
            $table->index(['area_id']);
        });

        $this->updateTimestampDefaultValue('campaign_areas', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_areas');
    }
}
