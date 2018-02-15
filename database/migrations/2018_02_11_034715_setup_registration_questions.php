<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupRegistrationQuestions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 1,
      'sectionname' => 'Essential details',
      'sectionshortname' => 'essential'
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
        'html5required' => True,
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
        'html5required' => True,
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
        'html5required' => True,
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
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'adelaide',
        'questiontext' => 'Do you live in Adelaide?',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 2,
      'sectionname' => 'Personal details',
      'sectionshortname' => 'personal'
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
        'responsevalidationlogic' => 'string|min:8|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'phoneduring',
        'questiontext' => 'Mobile number',
        'questiondescr' => 'Best number during the festival',
        'responseformat' => 'text:tel',
        'responsevalidationlogic' => 'string|min:10|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'post',
        'questiontext' => 'Postal address',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'aicsachoirs',
        'questiontext' => 'Which (past or present) AICSA choirs do you associate with (presently or historically)?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:ACU^ACU|AUCS^AUCS|FUCS^FUCS|LaTUCS^LaTUCS|MADS^MADS|MonUCS^MonUCS|MUCS^MUCS|MUS^MUS|MuscUTS^MuscUTS|PUCS^PUCS|QUMS^QUMS|ROCS^ROCS|SCUNA^SCUNA|SUMS^SUMS|TUMS^TUMS',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'nonaicsachoirs',
        'questiontext' => 'Which non AICSA choirs do you associate with?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Graduate Singers (Grads)^Grads|Elder Conservatorium Chorale^Chorale|Pilgrim Church^Pilgrim|Christ Church, North Adelaide^CCNA|OtherText',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => 'multiothertext',
      ],
    ]);
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 3,
      'sectionname' => 'Emergency contact details',
      'sectionshortname' => 'emergency'
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
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'emergencyrelationship',
        'questiontext' => 'Their relationship to you',
        'questiondescr' => NULL,
        'responseformat' => 'text:text',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'emergencyphone',
        'questiontext' => 'Their phone number',
        'questiondescr' => NULL,
        'responseformat' => 'text:tel',
        'responsevalidationlogic' => 'required|min:8',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'emergencyadditions',
        'questiontext' => 'Any other relevant information',
        'questiondescr' => 'e.g. Additional contact methods, Detailsf or another contact person',
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 4,
      'sectionname' => 'Dietary requirements',
      'sectionshortname' => 'food'
    ],'sectionid');
    
    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 1,
      'sectionid' => $sectionid,
      'subsectioncode' => 1,
      'subsectionname' => 'Food allergy and intolerance requirements',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'gf',
        'questiontext' => 'Gluten free meals required',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'badfood',
        'questiontext' => 'Does coming into contact with or consuming any of these ingredients make you ill?',
        'questiondescr' => 'Pick <b>severely</b> if even trace amounts make you ill and kitchen staff need to take special precautions to avoid contamination.<br>Pick <b>mildly</b> if trace amounts are fine and it’s satisfactory to just not be served it or to pick it out of your dish.',
        'responseformat' => 'subquestion-radio:Peanuts|Tree nuts|Milk|Eggs|Sesame|Fish|Shellfish|Soy|Wheat|Lupin|OtherText:Yes, severely^severe|Yes, mildly^mild|!No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'precautions',
        'questiontext' => 'Any non-trivial necessary precautions?',
        'questiondescr' => 'Our caterers are professionals and are familiar with trivial precautions, there’s no need to list them here.',
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'badfoodplan',
        'questiontext' => 'Emergency action plan',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    
    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => 2,
      'subsectionname' => 'Food restriction requirements',
      'subsectiondescr' => NULL,
    ],'subsectioncode');

    DB::table('rego_questions')->insert([
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'veg',
        'questiontext' => 'Vegetarian or vegan meals required',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes, vegetarian^vegetarian|Yes, vegan^vegan|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'animalproducts',
        'questiontext' => 'Any animal products you do not eat?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Red meat|Poultry|Fish|Other seafood|Eggs|Honey|Gelatin|Dairy',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);



    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => 3,
      'subsectionname' => 'Other food requirements',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 7,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'otherfood',
        'questiontext' => 'Other simple requirements',
        'questiondescr' => 'If you need to refine the above options, do that clearly here.',
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 8,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'complexfood',
        'questiontext' => 'Other complex requirements',
        'questiondescr' => 'You can use this space to describe complex dietary requirements. This is generally for people who might go out to a restaurant and not order any food because it’s too risky.',
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 4,
      'sectionid' => $sectionid,
      'subsectioncode' => 4,
      'subsectionname' => 'Food preferences (non requirements)',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
      
    DB::table('rego_questions')->insert([
      [
        'questionord' => 9,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'foodprefs',
        'questiontext' => 'If you have any food preferences that are not required, what are they?',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 5,
      'sectionname' => 'Choral experience',
      'sectionshortname' => 'choral'
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'voice',
        'questiontext' => 'Your primary voice part',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Soprano|Alto|Tenor|Bass',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'divisi',
        'questiontext' => 'Your primary divisi line',
        'questiondescr' => NULL,
        'responseformat' => 'radio:First|Second',
        'html5required' => True,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'sometimessings',
        'questiontext' => 'Other voice parts you can sing well on occasion',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Soprano|Alto|Tenor|Bass',
        'html5required' => False,
        'responsevalidationlogic' => 'required',
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 6,
      'sectionname' => 'Travel details',
      'sectionshortname' => 'travel'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 7,
      'sectionname' => 'Camp, billeting and accommodation',
      'sectionshortname' => 'cba'
    ],'sectionid');
    
    $subsectioncode = DB::table('rego_subsections')->insert([
      'subsectionord' => 1,
      'sectionid' => $sectionid,
      'subsectioncode' => 1,
      'subsectionname' => 'Camp',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    $subsectioncode = DB::table('rego_subsections')->insert([
      'subsectionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => 2,
      'subsectionname' => 'Billeting',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    $subsectioncode = DB::table('rego_subsections')->insert([
      'subsectionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => 3,
      'subsectionname' => 'Accommodation',
      'subsectiondescr' => NULL,
    ],'subsectioncode');

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 8,
      'sectionname' => 'Billeting details for hosts',
      'sectionshortname' => 'billeting'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 9,
      'sectionname' => 'Social event details',
      'sectionshortname' => 'social'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 10,
      'sectionname' => 'Merchandise sales',
      'sectionshortname' => 'merchandise'
    ],'sectionid');

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    // I guess, we could delete all records from these tables, but doesn’t really matter.
  }
}
