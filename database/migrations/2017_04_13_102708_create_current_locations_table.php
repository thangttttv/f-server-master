<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCurrentLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('longitude', 10, 7);
            $table->float('latitude', 10, 7);
            $table->timestamp('recorded_at');
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('campaign_id')->default(0);

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('current_locations', ['updated_at'], ['created_at', 'recorded_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_locations');
    }
}
