<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('description')->default('');
            $table->integer('order')->default(0);

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('banks', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
