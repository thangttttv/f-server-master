<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCampaignImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_id')->default(0)->index();
            $table->bigInteger('image_id')->default(0)->index();
            $table->decimal('base_revenue',12, 2)->default(0);
            $table->string('currency_code');
            $table->string('image_type')->index();

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('campaign_images', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_images');
    }
}
