<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtras extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::table('rego_questions')->insert([
      [
      'questionord' => 10,
      'sectionid' => DB::table('rego_sections')->select('sectionid')->where('sectionshortname','personal')->first()->sectionid,
      'subsectioncode' => NULL,
      'questionshortname' => 'ivhistory',
      'questiontext' => 'Which IVs have you been to in the past?',
      'questiondescr' => NULL,
      'responseformat' => 'textarea',
      'html5required' => False,
      'responsevalidationlogic' => 'string|nullable',
      'companionresponsevalidationlogic' => NULL,
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
    //
  }
}
