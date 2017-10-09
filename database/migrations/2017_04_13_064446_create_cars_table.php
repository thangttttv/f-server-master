<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('');
            $table->string('car_model')->default('');
            $table->string('license_plate_number')->default('');

            $table->integer('year_of_manufacture')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('image_id')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('cars', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
