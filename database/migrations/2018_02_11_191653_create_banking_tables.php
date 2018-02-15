<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankingTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bank_transactions', function (Blueprint $table) {
        $table->increments('id');
        $table->date('date');
        $table->string('description');
        $table->decimal('debit',8,2);
        $table->decimal('credit',8,2);
        $table->decimal('balance',8,2);
        $table->unique(['date','description','debit','credit','balance']);
    });
    
    Schema::create('bank_transaction_owners', function (Blueprint $table) {
        $table->unsignedInteger('transactionid');
        $table->unsignedInteger('ownerid')->nullable();
        $table->decimal('credit',8,2);
        $table->foreign('transactionid')->references('id')->on('bank_transactions');
        $table->foreign('ownerid')->references('id')->on('iv_users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('bank_transaction_owners');
    Schema::dropIfExists('bank_transactions');
  }
}
