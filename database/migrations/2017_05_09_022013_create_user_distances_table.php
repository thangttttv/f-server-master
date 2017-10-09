<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateUserDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_distances', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('campaign_id')->default(0);
            $table->bigInteger('area_id')->default(0);
            $table->decimal('distance')->default(0);
            $table->decimal('total_cost')->default(0);
            $table->decimal('total_impression')->default(0);
            $table->date('date')->nullable();

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('user_distances', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_distances');
    }
}
