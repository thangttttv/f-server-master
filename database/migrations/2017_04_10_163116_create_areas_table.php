<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_en')->default('');
            $table->string('name_local')->default('');

            $table->integer('city_id')->default(0)->index();
            $table->string('country_code')->default('');

            $table->double('longitude')->default(0);
            $table->double('latitude')->default(0);
            $table->double('radius')->default(0);
            $table->longText('location_data')->default(null);

            $table->integer('order')->default(0)->index();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['city_id', 'order']);
        });

        $this->updateTimestampDefaultValue('areas', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
