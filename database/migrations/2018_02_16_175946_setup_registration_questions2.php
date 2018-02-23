<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupRegistrationQuestions2 extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 11,
      'sectionname' => 'Permission',
      'sectionshortname' => 'permission'
    ],'sectionid');

    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'nameinprogramme',
        'questiontext' => 'My name (%) can appear in the concert programme.',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'nametochoristers',
        'questiontext' => 'My name (%) can be distributed to other choristers.',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'mobiletochoristers',
        'questiontext' => 'My mobile number (%) can be distributed to other choristers.',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'choirstochoristers',
        'questiontext' => 'My choirs (%) can be distributed to other choristers.',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'nameontshirt',
        'questiontext' => 'My name (%) appear on the festival T shirt.',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
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
