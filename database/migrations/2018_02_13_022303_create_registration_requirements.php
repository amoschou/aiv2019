<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationRequirements extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('rego_requirements', function (Blueprint $table) {
      $table->increments('requirementid');
      $table->string('questionshortname');
      $table->text('comparisonoperator');
      $table->text('responsepattern');
      $table->string('doasksection')->nullable();
      $table->string('donotasksection')->nullable();
      $table->string('doaskquestion')->nullable();
      $table->string('donotaskquestion')->nullable();
      $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
      $table->foreign('doasksection')->references('sectionshortname')->on('rego_sections');
      $table->foreign('donotasksection')->references('sectionshortname')->on('rego_sections');
      $table->foreign('doaskquestion')->references('questionshortname')->on('rego_questions');
      $table->foreign('donotaskquestion')->references('questionshortname')->on('rego_questions');
    });
    
    // Only "doasksection" is implemented at this stage.
    // "donotasksection", "doaskquestion" and "donotaskquestion" will not work.
    
    DB::table('rego_requirements')->insert([
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => 'LIKE',
        'responsepattern' => '%_%',
        'doasksection' => 'essential',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => 'LIKE',
        'responsepattern' => '%_%',
        'doasksection' => 'personal',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'singing',
        'doasksection' => 'emergency',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'singing',
        'doasksection' => 'emergency',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'social',
        'doasksection' => 'emergency',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'singing',
        'doasksection' => 'food',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'social',
        'doasksection' => 'food',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'singing',
        'doasksection' => 'choral',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'singing',
        'doasksection' => 'cba',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'social',
        'doasksection' => 'social',
      ],
      [
        'questionshortname' => 'adelaide',
        'comparisonoperator' => '?',
        'responsepattern' => 'no',
        'doasksection' => 'travel',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => 'LIKE',
        'responsepattern' => '%',
        'doasksection' => 'merchandise',
      ],
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'billeting',
        'doasksection' => 'billeting',
      ],
    ]);


  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('rego_requirements');
  }
}
