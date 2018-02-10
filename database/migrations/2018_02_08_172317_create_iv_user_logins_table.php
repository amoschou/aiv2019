<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvUserLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iv_user_logins', function (Blueprint $table) {
            $table->integer('id');
            $table->text('token')->unique();
            $table->text('session')->unique();
            $table->boolean('remember');
            $table->timestampTz('created_at')->useCurrent();
            $table->foreign('id')->references('id')->on('iv_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iv_user_logins');
    }
}
