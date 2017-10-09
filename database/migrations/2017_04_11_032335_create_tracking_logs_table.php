<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateTrackingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->default(0)->index();
            $table->date('date')->index();
            $table->bigInteger('campaign_id')->default(0)->index();

            $table->decimal('distance',12,2)->default(0);
            $table->decimal('revenue', 12,2)->default(0);

            $table->string('revenue_currency_code')->default('');

            $table->longText('trajectory')->nullable();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('tracking_logs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_logs');
    }
}
