<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_en');
            $table->string('name_local');

            $table->string('country_code')->index();

            $table->integer('order')->default(0)->index();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['country_code', 'order']);
        });

        $this->updateTimestampDefaultValue('cities', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
