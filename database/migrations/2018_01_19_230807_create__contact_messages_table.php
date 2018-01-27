<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactmessages', function (Blueprint $table) {
            $table->increments('messageid');
            $table->text('name');
            $table->text('email');
            $table->text('subject');
            $table->text('message');
            $table->timestampTz('created_at')->useCurrent();
        });
//        DB::statement('ALTER TABLE contactmessages ADD created_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactmessages');
    }
}
