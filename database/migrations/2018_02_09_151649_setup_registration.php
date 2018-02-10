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
            $table->integer('sectionord')->unique();
        });
        Schema::create('rego_subsections', function (Blueprint $table) {
            $table->increments('subsectionid');
            $table->integer('sectionid');
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
            $table->integer('sectionid');
            $table->integer('subsectioncode')->nullable();
            $table->text('questionshortname')->unique();
            $table->text('questiontext');
            $table->text('questiondescr')->nullable();
            $table->text('responseformat');
            $table->text('responserequired')->nullable();
            $table->text('responsevalidationlogic')->nullable();
            $table->text('companionresponsevalidationlogic')->nullable();
            $table->integer('questionord');
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
            $table->foreign(['sectionid','subsectioncode'])->references(['sectionid','subsectioncode'])->on('rego_subsections');
        });
        Schema::create('rego_responses', function (Blueprint $table) {
            $table->increments('responseid');
            $table->integer('userid');
            $table->text('questionshortname');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
            $table->unique(['userid','questionshortname']);
        });
        Schema::create('rego_responses_nofk', function (Blueprint $table) {
            $table->increments('responseid');
            $table->integer('userid');
            $table->text('attributename');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->unique(['userid','attributename']);
        });
        Schema::create('rego_mustask', function (Blueprint $table) {
            $table->integer('userid');
            $table->integer('sectionid');
            $table->boolean('submitted')->default(False);
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
            $table->primary(['userid','sectionid']);
        });
        break;
      
      case('mysql'):
        Schema::create('rego_sections', function (Blueprint $table) {
            $table->increments('sectionid');
            $table->string('sectionname')->unique();
            $table->integer('sectionord')->unique();
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
            $table->string('questionshortname')->unique();
            $table->text('questiontext');
            $table->text('questiondescr')->nullable();
            $table->text('responseformat');
            $table->text('responserequired')->nullable();
            $table->text('responsevalidationlogic')->nullable();
            $table->text('companionresponsevalidationlogic')->nullable();
            $table->integer('questionord');
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
            $table->foreign(['sectionid','subsectioncode'])->references(['sectionid','subsectioncode'])->on('rego_subsections');
        });
        Schema::create('rego_responses', function (Blueprint $table) {
            $table->increments('responseid');
            $table->integer('userid');
            $table->string('questionshortname');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
            $table->unique(['userid','questionshortname']);
        });
        Schema::create('rego_responses_nofk', function (Blueprint $table) {
            $table->increments('responseid');
            $table->integer('userid');
            $table->string('attributename');
            $table->json('responsejson');
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->unique(['userid','attributename']);
        });
        Schema::create('rego_mustask', function (Blueprint $table) {
            $table->integer('userid');
            $table->integer('sectionid');
            $table->boolean('submitted')->default(False);
            $table->foreign('userid')->references('id')->on('iv_users');
            $table->foreign('sectionid')->references('sectionid')->on('rego_sections');
            $table->primary(['userid','sectionid']);
        });
        break;
    }



    
    
    // SECONDLY POPULATE THE TABLES
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 1,
      'sectionname' => 'Essential details'
    ],'sectionid');
    /*
     *  Do not rename "Essential details" to something else.
     *  It is hard referenced in several places.
     */
    
    // The following inserts into rego_mustask wouldn't
    // normally need to be here. It's normally done when
    // signing up to the site. But in development, migration
    // rollbacks lose this data, so it is inserted here.
/*
    $users = DB::table('iv_users')->select('id')->get();
    foreach($users as $user)
    {
      if(DB::table('rego_mustask')
           ->where('userid',$user->id)
           ->where('sectionid',$sectionid)
           ->doesntExist())
      {
        DB::table('rego_mustask')->insert([
          'userid' => $user->id,
          'sectionid' => $sectionid
        ]);
      }
    }
*/

    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'firstname',
        'questiontext' => 'First name',
        'questiondescr' => NULL,
        'responseformat' => 'text:text',
        'responserequired' => True,
        'responsevalidationlogic' => 'required|string',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'lastname',
        'questiontext' => 'Last name',
        'questiondescr' => NULL,
        'responseformat' => 'text:text',
        'responserequired' => True,
        'responsevalidationlogic' => 'required|string',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'pronoun',
        'questiontext' => 'Pronoun',
        'questiondescr' => 'If you don’t know what this means, pick <strong>He</strong> if you’re a man or <strong>She</strong> if you’re a woman.',
        'responseformat' => 'radio:She|He|They|OtherText',
        'responserequired' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => 'othertext:required_if:pronoun,othertext|string|nullable',
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'doing',
        'questiontext' => 'How are you participating in this festival?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:As a chorister^singing|At social events^social|Hosting billeted choristers^billeting',
        'responserequired' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 2,
      'sectionname' => 'Personal details'
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'phonebefore',
        'questiontext' => 'Phone number',
        'questiondescr' => 'Best number prior to the festival',
        'responseformat' => 'text:tel',
        'responserequired' => False,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'phoneduring',
        'questiontext' => 'Mobile number',
        'questiondescr' => 'Best number during the festival',
        'responseformat' => 'text:tel',
        'responserequired' => False,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'post',
        'questiontext' => 'Postal address',
        'questiondescr' => NULL,
        'responseformat' => 'text:address',
        'responserequired' => False,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'aicsachoirs',
        'questiontext' => 'Which (past or present) AICSA choirs do you associate with (presently or historically)?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:ACU|AUCS|FUCS|LaTUCS|MADS|MonUCS|MUCS|MUS|MuscUTS|PUCS|QUMS|ROCS|SCUNA|SUMS|TUMS',
        'responserequired' => False,
      ],
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'nonaicsachoirs',
        'questiontext' => 'Which non AICSA choirs do you associate with?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Graduate Singers (Grads)^grads|Elder Conservatorium Chorale^chorale|Pilgrim Church^pilgrim|Christ Church, North Adelaide^ccna|OtherText',
        'responserequired' => False,
      ],
    ]);
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 3,
      'sectionname' => 'Emergency contact details'
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'emergencyname',
        'questiontext' => 'Name of emergency contact',
        'questiondescr' => NULL,
        'responseformat' => 'text:text',
        'responserequired' => True,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'emergencyrelationship',
        'questiontext' => 'Their relatioship to you',
        'questiondescr' => NULL,
        'responseformat' => 'text:text',
        'responserequired' => True,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'emergencyphone',
        'questiontext' => 'Their phone number',
        'questiondescr' => NULL,
        'responseformat' => 'text:tel',
        'responserequired' => True,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 4,
      'sectionname' => 'Dietary requirements'
    ],'sectionid');
    
    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 1,
      'sectionid' => $sectionid,
      'subsectioncode' => 1,
      'subsectionname' => 'Food allergy and intolerance requirements',
      'subsectiondescr' => 'In this section:<ul><li>Elaborate <strong>Severe</strong> even if trace amounts make you ill and the kitchen staff need to take special precautions to avoid contamination.</li><li>Elaborate <strong>Moderate</strong> if trace amounts are fine and it’s satisfactory to just not be served it or to pick it out of your dish.</li></ul>',
    ],'subsectionid');
    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => 2,
      'subsectionname' => 'Food restriction requirements',
      'subsectiondescr' => NULL,
    ],'subsectionid');
    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => 3,
      'subsectionname' => 'Other food requirements',
      'subsectiondescr' => NULL,
    ],'subsectionid');
    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 4,
      'sectionid' => $sectionid,
      'subsectioncode' => 4,
      'subsectionname' => 'Food preferences (non requirements)',
      'subsectiondescr' => NULL,
    ],'subsectionid');
      
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 5,
      'sectionname' => 'Choral experience'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 6,
      'sectionname' => 'Travel details'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 7,
      'sectionname' => 'Camp, billeting and accommodation'
    ],'sectionid');
    
    $subsectionid = DB::table('rego_subsections')->insert([
      'subsectionord' => 1,
      'sectionid' => $sectionid,
      'subsectioncode' => 1,
      'subsectionname' => 'Camp',
      'subsectiondescr' => NULL,
    ],'subsectionid');
    $subsectionid = DB::table('rego_subsections')->insert([
      'subsectionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => 2,
      'subsectionname' => 'Billeting',
      'subsectiondescr' => NULL,
    ],'subsectionid');
    $subsectionid = DB::table('rego_subsections')->insert([
      'subsectionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => 3,
      'subsectionname' => 'Accommodation',
      'subsectiondescr' => NULL,
    ],'subsectionid');

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 8,
      'sectionname' => 'Billeting details for hosts'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 9,
      'sectionname' => 'Social event details'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 10,
      'sectionname' => 'Merchandise sales'
    ],'sectionid');

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