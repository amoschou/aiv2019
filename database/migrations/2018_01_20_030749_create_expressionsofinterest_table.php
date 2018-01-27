<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressionsOfInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expressionsofinterest', function (Blueprint $table) {
            $table->increments('expressionid');
            $table->text('name');
            $table->text('email');
            $table->text('phone');
            $table->text('receipt');
            $table->timestampTz('created_at')->useCurrent();
        });
//        DB::statement('ALTER TABLE expressionsofinterest ADD created_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expressionsofinterest');
    }
}
