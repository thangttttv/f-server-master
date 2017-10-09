<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;


class CreateAdvertiserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('advertiser_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('advertiser_id')->default(0);

            $table->string('category_type')->default(0);

            $table->string('type')->default('');
            $table->text('data')->nullable();
            $table->text('content')->default('');

            $table->string('locale')->default('');

            $table->boolean('read')->default(false);
            $table->timestamp('sent_at');

            $table->timestamps();

            $table->index(['category_type', 'advertiser_id', 'locale', 'sent_at'], 'category_advertiser_index');
            $table->index(['type', 'advertiser_id', 'locale', 'sent_at']);
            $table->index(['advertiser_id', 'locale', 'sent_at']);
            $table->index(['read', 'advertiser_id', 'locale', 'sent_at']);
        });

        $this->updateTimestampDefaultValue('advertiser_notifications', ['updated_at'], ['sent_at', 'created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('advertiser_notifications');
    }
}
