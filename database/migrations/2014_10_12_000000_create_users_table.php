<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');

            $table->string('phone_number')->default('');
            $table->string('email');
            $table->string('password', 60);
            $table->date('date_of_birth')->nullable();
            $table->string('current_latitude')->default('');
            $table->string('current_longitude')->default('');

            $table->string('locale')->default('');
            $table->string('country_code')->default('')->index();
            $table->bigInteger('city_id')->default(0);
            $table->bigInteger('main_area_id')->default(0);

            $table->bigInteger('profile_image_id')->default(0);
            $table->bigInteger('drivers_licence_image_id')->default(0);

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('users', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
