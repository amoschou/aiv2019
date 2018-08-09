<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicQuestions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 45,
      'sectionname' => 'Repertoire',
      'sectionshortname' => 'repertoire',
      'sectiondescr' => 'For each work being performed at Adelaide IV, there are three options. You can:<ul><li><em>Borrow</em> the score for the duration of the festival.</li><li><em>Buy</em> the score from us, to be provided to you at the start of the festival.</li><li><em>Bring</em> your own legal copy of the score to the festival if you already own it.</li></ul>',
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scorearnesen',
        'questiontext' => 'Arnesen: <em>Magnificat</em>',
        'questiondescr' => '$15 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scorepart',
        'questiontext' => 'Pärt: <em>Magnificat</em>',
        'questiondescr' => '$12 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scoreesenvalds',
        'questiontext' => 'Ešenvalds: <em>Stars</em>',
        'questiondescr' => '$7 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scoregjeilo',
        'questiontext' => 'Gjeilo: <em>Northern lights</em>',
        'questiondescr' => '$4 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scoresandstrom',
        'questiontext' => 'Sandström: <em>Es ist ein Ros entsprungen</em>',
        'questiondescr' => '$4 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scoredove',
        'questiontext' => 'Dove: <em>Seek him that maketh the seven stars</em>',
        'questiondescr' => '$5 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 7,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scorelauridsenii',
        'questiontext' => 'Lauridsen: ‘Soneto de la noche’ from <em>Nocturnes</em>',
        'questiondescr' => '$4 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 8,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scorelauridseniii',
        'questiontext' => 'Lauridsen: ‘Sure on this shining night’ from <em>Nocturnes</em>',
        'questiondescr' => '$3 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 9,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'scorewhitacre',
        'questiontext' => 'Whitacre: <em>The seal lullaby</em>',
        'questiondescr' => '$5 to buy',
        'responseformat' => 'radio:Borrow|Buy|Bring',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    DB::table('rego_requirements')->insert([
      [
        'questionshortname' => 'doing',
        'comparisonoperator' => '?',
        'responsepattern' => 'singing',
        'doasksection' => 'repertoire',
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
