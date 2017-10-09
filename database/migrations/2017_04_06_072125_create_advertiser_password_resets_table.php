<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAdvertiserPasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('advertiser_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        $this->updateTimestampDefaultValue('password_resets', [], ['created_at']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_password_resets');
    }
}
