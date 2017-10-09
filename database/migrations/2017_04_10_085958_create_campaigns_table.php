<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->default('');
            $table->text('description')->nullable();

            $table->decimal('distance', 12, 3)->default(0);
            $table->decimal('minimum_revenue', 12, 2)->default(0);
            $table->decimal('maximum_revenue', 12, 2)->default(0);

            $table->string('budget_currency_code')->default('');

            $table->decimal('budget', 12, 2)->default(0);
            $table->decimal('spend', 12, 2)->default(0);
            $table->decimal('total_impression', 12, 2)->default(0);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('');

            $table->bigInteger('brand_image_id')->default(0);
            $table->string('country_code')->default('');
            $table->bigInteger('city_id')->default(0);
            $table->bigInteger('advertiser_id')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->index(['country_code', 'city_id', 'start_date', 'end_date']);
        });

        $this->updateTimestampDefaultValue('campaigns', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
