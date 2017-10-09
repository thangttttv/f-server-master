<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('code');

            $table->string('name_en');
            $table->string('name_local');

            $table->string('flag_image_id')->default(0);

            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index('code');
        });

        $this->updateTimestampDefaultValue('countries', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
