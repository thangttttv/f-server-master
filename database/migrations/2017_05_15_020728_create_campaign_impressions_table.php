<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCampaignImpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_impressions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_id')->default(0);
            $table->decimal('total_impression')->default(0);
            $table->decimal('total_cost')->default(0);
            $table->date('date')->nullable();

            $table->timestamps();

        });

        $this->updateTimestampDefaultValue('campaign_impressions', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_impressions');
    }
}
