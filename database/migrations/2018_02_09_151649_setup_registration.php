<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupRegistration extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
  
    // FIRSTLY CREATE THE TABLES
    

    switch(config('database.default'))
    {
      case('pgsql'):
        Schema::create('rego_sections', function (Blueprint $table) {
            $table->increments('sectionid');
            $table->text('sectionname')->unique();
            $table->text('sectionshortname')->unique();
            $table->text('sectiondescr')->nullable();
            $table->text('sectionduplicateforeach')->nullable();
            $table->integer('sectionord')->unique();
//            $table->foreign('sectionduplicateforeach')->references('questionid')->on('rego_questions');
        });
        Schema::create('rego_subsections', function (Blueprint $table) {
            $table->increments('subsectionid');
            $table->integer('sectionid');
            $table->integer('subsectioncode');
            $table->text('subsectionname');
            $table->text('subsectiondescr')->nullable();
            $table->integer('subsectionord');
            $table->unique(['sectionid','subsectioncode']);
            $table->unique(['sectionid','subsectionname']);
            $table->unique(['sectionid','subsectionord']);
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
        });
        Schema::create('rego_questions', function (Blueprint $table) {
            $table->increments('questionid');
            $table->integer('sectionid');
            $table->integer('subsectioncode')->nullable();
            $table->text('questionshortname')->unique();
            $table->text('questiontext');
            $table->text('questiondescr')->nullable();
            $table->text('responseformat');
            $table->boolean('html5required');
            $table->text('responsevalidationlogic')->nullable();
            $table->text('companionresponsevalidationlogic')->nullable();
            $table->integer('questionord');
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
            $table->foreign(['sectionid','subsectioncode'])->references(['sectionid','subsectioncode'])->on('rego_subsections');
        });
        Schema::create('rego_responses', function (Blueprint $table) {
            $table->increments('responseid');
            $table->integer('userid');
            $table->text('foritem');
            $table->text('questionshortname');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
            $table->unique(['userid','foritem','questionshortname']);
        });
        Schema::create('rego_responses_nofk', function (Blueprint $table) {
            $table->increments('responseid');
            $table->integer('userid');
            $table->text('foritem');
            $table->text('attributename');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->unique(['userid','foritem','attributename']);
        });
//        Schema::create('rego_mustask', function (Blueprint $table) {
//            $table->integer('userid');
//            $table->integer('sectionid');
//            $table->boolean('submitted')->default(False);
//            $table->foreign('userid')->references('id')->on('iv_users');
//            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
//            $table->primary(['userid','sectionid']);
//        });
        break;
      
      case('mysql'):
        Schema::create('rego_sections', function (Blueprint $table) {
            $table->increments('sectionid');
            $table->string('sectionname')->unique();
            $table->string('sectionshortname')->unique();
            $table->string('sectiondescr')->nullable();
            $table->string('sectionduplicateforeach')->nullable();
            $table->integer('sectionord')->unique();
//            $table->foreign('sectionduplicateforeach')->references('questionid')->on('rego_questions');
        });
        Schema::create('rego_subsections', function (Blueprint $table) {
            $table->increments('subsectionid');
            $table->unsignedInteger('sectionid');
            $table->integer('subsectioncode');
            $table->string('subsectionname');
            $table->text('subsectiondescr')->nullable();
            $table->integer('subsectionord');
            $table->unique(['sectionid','subsectioncode']);
            $table->unique(['sectionid','subsectionname']);
            $table->unique(['sectionid','subsectionord']);
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
        });
        Schema::create('rego_questions', function (Blueprint $table) {
            $table->increments('questionid');
            $table->unsignedInteger('sectionid');
            $table->integer('subsectioncode')->nullable();
            $table->string('questionshortname')->unique();
            $table->text('questiontext');
            $table->text('questiondescr')->nullable();
            $table->text('responseformat');
            $table->boolean('html5required');
            $table->text('responsevalidationlogic')->nullable();
            $table->text('companionresponsevalidationlogic')->nullable();
            $table->integer('questionord');
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
            $table->foreign(['sectionid','subsectioncode'])->references(['sectionid','subsectioncode'])->on('rego_subsections');
        });
        Schema::create('rego_responses', function (Blueprint $table) {
            $table->increments('responseid');
            $table->unsignedInteger('userid');
            $table->string('foritem');
            $table->string('questionshortname');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
            $table->unique(['userid','foritem','questionshortname']);
        });
        Schema::create('rego_responses_nofk', function (Blueprint $table) {
            $table->increments('responseid');
            $table->unsignedInteger('userid');
            $table->text('foritem');
            $table->string('attributename');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->unique(['userid','foritem','attributename']);
        });
//        Schema::create('rego_mustask', function (Blueprint $table) {
//            $table->unsignedInteger('userid');
//            $table->unsignedInteger('sectionid');
//            $table->boolean('submitted')->default(False);
//            $table->foreign('userid')->references('id')->on('iv_users');
//            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
//            $table->primary(['userid','sectionid']);
//        });
        break;
    }
    
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('rego_mustask');
    Schema::dropIfExists('rego_responses_nofk');
    Schema::dropIfExists('rego_responses');
    Schema::dropIfExists('rego_questions');
    Schema::dropIfExists('rego_subsections');
    Schema::dropIfExists('rego_sections');
  }
}
