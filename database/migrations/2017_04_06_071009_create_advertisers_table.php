<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->default('');

            $table->string('email');
            $table->string('password', 60);

            $table->string('locale')->default('');

            $table->bigInteger('profile_image_id')->default(0);

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('advertisers', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisers');
    }
}
