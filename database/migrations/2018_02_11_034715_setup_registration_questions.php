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
      'sectionshortname' => 'essential',
    ],'sectionid');
    /*
     *  Do not rename "Essential details" to something else.
     *  It is hard referenced in several places.
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
      'sectionshortname' => 'personal',
      'sectiondescr' => 'We encourage you to provide your mobile number. Sometimes it is more appropriate to contact you this way, especially if an urgent response is required. It also lets us SMS you.',
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
      'sectionshortname' => 'emergency',
      'sectiondescr' => 'The primary emergency contact is the person not attending the festival who you would like us to contact first should you experience an emergency.',
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
        'questiondescr' => 'e.g. Additional contact methods, Details for another contact person',
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 4,
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
      'sectionord' => 5,
      'sectionname' => 'Travel details',
      'sectionshortname' => 'travel',
      'sectiondescr' => 'Although we are asking for travel details, this is only informative, so we know around about when you’ll arrive and leave. That’s all. In ordinary circumstances, we expect you to make it from the airport into the city with your luggage on your own, similarly returning to the airport for departure. Unless you have special needs, <strong>we are not offering airport pickups and dropoffs</strong> because registration is easily and cheaply accessible by public transport from the airport.',
    ],'sectionid');
    
    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 1,
      'sectionid' => $sectionid,
      'subsectioncode' => 1,
      'subsectionname' => 'Arriving',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'arrtype',
        'questiontext' => 'Arriving by',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Plane|Train|Bus|Private vehicle^private',
        'responsevalidationlogic' => 'nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'arrvessel',
        'questiontext' => 'Vessel of arrival',
        'questiondescr' => 'Flight number, train line or bus company',
        'responseformat' => 'text:text',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'arrat',
        'questiontext' => 'Point of arrival',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Adelaide Airport^airport|Adelaide Parklands Terminal^parklands|Adelaide Central Bus Station^central|OtherText',
        'responsevalidationlogic' => 'nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => 'othertext:required_if:arrat,othertext|string|nullable',
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'arrdatetime',
        'questiontext' => 'Date and time of arrival',
        'questiondescr' => NULL,
        'responseformat' => 'text:datetime-local',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => 2,
      'subsectionname' => 'Departing',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'deptype',
        'questiontext' => 'Departing by',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Plane|Train|Bus|Private vehicle^private',
        'responsevalidationlogic' => 'nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'depvessel',
        'questiontext' => 'Vessel of departure',
        'questiondescr' => 'Flight number, train line or bus company',
        'responseformat' => 'text:text',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 7,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'depat',
        'questiontext' => 'Point of departure',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Adelaide Airport^airport|Adelaide Parklands Terminal^parklands|Adelaide Central Bus Station^central|OtherText',
        'responsevalidationlogic' => 'nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => 'othertext:required_if:depat,othertext|string|nullable',
      ],
      [
        'questionord' => 8,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'depdatetime',
        'questiontext' => 'Date and time of departure',
        'questiondescr' => NULL,
        'responseformat' => 'text:datetime-local',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    $subsectioncode = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => 3,
      'subsectionname' => 'Special assistance',
      'subsectiondescr' => NULL,
    ],'subsectioncode');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 9,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'transporthelp',
        'questiontext' => 'If (and only if) you <strong>require</strong> special assistance at arrival and departure, please describe that here.',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 6,
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
      'sectionord' => 7,
      'sectionname' => 'Billeting details for hosts',
      'sectionshortname' => 'billeting'
    ],'sectionid');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 8,
      'sectionname' => 'Social event details',
      'sectionshortname' => 'social',
      'sectiondescr' => 'Guests are permitted only at the academic dinner. However, anybody is welcome to make their own social registration to attend other social events.'
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'accdinner',
        'questiontext' => 'Will you be at the academic dinner?',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    $accdinnerguestquestionshortname = DB::table('rego_questions')->insertGetId([
      'questionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => NULL,
      'questionshortname' => 'accdinnerguest',
      'questiontext' => 'Name of your guest to the academic dinner',
      'questiondescr' => NULL,
      'responseformat' => 'checkbox:OtherText',
      'responsevalidationlogic' => 'required',
      'html5required' => False,
      'companionresponsevalidationlogic' => 'multiothertext',
    ],'questionshortname');
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 9,
      'sectionname' => 'Dietary requirements',
      'sectionshortname' => 'food',
      'sectionduplicateforeach' => $accdinnerguestquestionshortname
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
    ]);
    DB::table('rego_questions')->insert([
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
    ]);
    DB::table('rego_questions')->insert([
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
    ]);
    DB::table('rego_questions')->insert([
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
    ]);
    DB::table('rego_questions')->insert([
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => $subsectioncode,
        'questionshortname' => 'animalproducts',
        'questiontext' => 'Any animal products you do not eat?',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Red meat|Poultry|Fish|Other seafood|Eggs|Honey|Gelatin|Dairy',
        'responsevalidationlogic' => 'required',
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
    ]);
    DB::table('rego_questions')->insert([
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
    DB::statement('delete from rego_responses');
    DB::statement('delete from rego_questions');
    DB::statement('delete from rego_subsections');
    DB::statement('delete from rego_sections');
    // I guess, we could delete all records from these tables, but doesn’t really matter.
  }
}
