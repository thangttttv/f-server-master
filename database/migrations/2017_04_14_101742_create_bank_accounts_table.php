<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;


class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id');
            $table->bigInteger('bank_id');
            $table->string('owner_name')->default('');
            $table->string('branch_name')->default('');
            $table->string('account_info');

            $table->timestamps();

            $table->index(['user_id']);
            $table->index(['bank_id']);
        });

        $this->updateTimestampDefaultValue('bank_accounts', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
