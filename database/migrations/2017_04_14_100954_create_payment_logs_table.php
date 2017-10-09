<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('bank_account_id')->default(0);
            $table->string('status')->default('');

            $table->integer('paid_amount')->default(0);
            $table->string('paid_for_month')->default(date('Y-m'));
            $table->string('currency_code')->default('');
            $table->date('paid_at');
            $table->text('note')->default('');

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('payment_logs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_logs');
    }
}
