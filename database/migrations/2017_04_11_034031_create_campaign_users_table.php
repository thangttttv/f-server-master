<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCampaignUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_id')->index();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('wrapping_image_id')->index();
            $table->string('status')->index();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('campaign_users', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_users');
    }
}
