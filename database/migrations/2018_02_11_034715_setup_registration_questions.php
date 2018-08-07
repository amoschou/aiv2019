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
      'sectionord' => 10,
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
      'sectionord' => 20,
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
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'concession',
        'questiontext' => 'Do you have a valid concession?',
        'questiondescr' => 'For valid concession, students are enrolled full time at any Australian university during Semester Two, 2018 or Semester One, 2019 (or equivalent), and youths are born on or after 10 January 1989.',
        'responseformat' => 'checkbox:Student^student|Youth^youth',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 7,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'concessionproof',
        'questiontext' => 'Evidence for concession',
        'questiondescr' => 'If you have a valid concession, please upload a copy of an official document (in PDF, JPEG or TIFF format) showing your date of birth or enrolment status. Alternatively, be prepared to show these to us when you first arrive in Adelaide.',
        'responseformat' => 'files:image/jpeg,image/tiff,application/pdf',
        'responsevalidationlogic' => 'nullable|mimes:pdf,jpeg,jpg,jpe,tif,tiff',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 8,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'specialrequirements',
        'questiontext' => 'Do you have any special requirements we need to be made aware of?',
        'questiondescr' => 'e.g. access to a fridge to store medication, service dog, wheelchair access',
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 30,
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
      'sectionord' => 40,
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
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'fresher',
        'questiontext' => 'Is this your first IV as a chorister?',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 50,
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
        'questiontext' => 'If (and only if) you <strong>require</strong> special assistance at arrival or departure, please describe that here.',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 60,
      'sectionname' => 'Accommodation',
      'sectionshortname' => 'accommodation'
    ],'sectionid');
    
    // Camp questions
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'sleepingatcamp',
        'questiontext' => 'Sleeping at camp',
        'questiondescr' => 'If you are not sleeping at camp, be sure to arrange your own accommodation and commute to and from camp every day.',
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'accommodation',
        'questiontext' => 'If you are not a student or if you are not requesting billeting, where are you staying during time outside camp (i.e. 10th–11th, 15th–20th January)',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // Billeting
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 65,
      'sectionname' => 'Billeting accommodation',
      'sectionshortname' => 'billetingaccommodation',
      'sectiondescr' => 'Note: Billeting is available only to student choristers.'
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'billetingrequest',
        'questiontext' => 'I would like to be billeting on these nights:',
        'questiondescr' => 'We will endeavour to find a place for all student choristers.',
        'responseformat' => 'checkbox:Thursday, 10th^10th|Tuesday, 15th^15th|Wednesday, 16th^16th|Thursday, 17th^17th|Friday, 18th^18th|Saturday, 19th^19th',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'billetingwhitelist',
        'questiontext' => 'I would like to be billeted with:',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|nullable',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'billetingblacklist',
        'questiontext' => 'I do not want to be billeted with:',
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
        'questionshortname' => 'guestsmoketolerance',
        'questiontext' => 'I can be billeted in a house with smokers',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes, I don’t mind smoke^yes|Yes, if they smoke outside^Yes (Outside)|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'guestpettolerance',
        'questiontext' => 'I can be billeted in a house with allergenic pets',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes, I don’t experience pet allergies^yes|Yes, if they are not highly allergenic^Yes (Mildly allergenic)|Yes, if they are separated from living areas^Yes (Separated)|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'guesthousedynamic',
        'questiontext' => 'I don’t mind staying in a:',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Quiet house|Moderately noisy house|Party house',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 7,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'guesthousecomposition',
        'questiontext' => 'I would prefer to stay with people who are:',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Students|Wokers|Female|Male|Queer friendly',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 70,
      'sectionname' => 'Billeting details for hosts',
      'sectionshortname' => 'billeting',
      'sectiondescr' => 'Hosts will need to provide sleeping space, bathroom, access (e.g. lending a spare key or being available to unlock in evenings) and luggage storage. It is customary to offer breakfast, no other meals are necessary. You can expect a gift from your guests.',
    ],'sectionid');
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostoffer',
        'questiontext' => 'I can host student choristers in my home on these nights:',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Thursday, 10th^10th|Tuesday, 15th^15th|Wednesday, 16th^16th|Thursday, 17th^17th|Friday, 18th^18th|Saturday, 19th^19th',
        'responsevalidationlogic' => 'required|min:1',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostsituation',
        'questiontext' => 'Describe the accommodation situation  at your house:',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|required',
        'questiondescr' => 'Example: We have a spare room with a double bed, a couch that one person can sleep on, and enough floor space for two more people.',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostaddress',
        'questiontext' => 'Address',
        'questiondescr' => NULL,
        'responseformat' => 'textarea',
        'responsevalidationlogic' => 'string|required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hosttransport',
        'questiontext' => 'Public transport',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Trains are nearby^Trains|Trams are nearby^Trams|Busses are nearby^Busses|Direct route to the city^Direct',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 5,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostsmoking',
        'questiontext' => 'Smoking',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Strictly non smoking^No|Outside only^outside|Permitted^Yes',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostserviceanimal',
        'questiontext' => 'Serive animal friendly',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 6,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostpets',
        'questiontext' => 'This house keeps roaming pets',
        'questiondescr' => 'Roaming pets include cats, dogs, indoor birds, etc.',
        'responseformat' => 'radio:Yes (Not allergenic)|Yes (Mildly allergenic)|Yes (Highly allergenic)|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 7,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostdynamic',
        'questiontext' => 'This house can be',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Quiet house|Moderately noisy house|Party house',
        'responsevalidationlogic' => 'required|min:1',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 8,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'hostpeople',
        'questiontext' => 'The people living here are:',
        'questiondescr' => NULL,
        'responseformat' => 'checkbox:Students|Workers|Female|Male|Queer friendly',
        'responsevalidationlogic' => 'required',
        'html5required' => False,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);

    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 80,
      'sectionname' => 'Social event details',
      'sectionshortname' => 'social',
      'sectiondescr' => 'Guests are permitted only at the academic dinner. However, anybody is welcome to make their own social registration to attend other social events.'
    ],'sectionid');
    
    // It doesn't look like that acdinner and acdinnerguest can be
    // validated using the abstract approach like everything else here
    // so one of the rules is done manually:
    //
    //   IF THERE'S AN ACADEMIC DINNER GUEST,
    //   THEN YOU MUST BE GOING TO THE DINNER YOURSELF.
    //
    // Look at app/Http/Controllers/HomeController.php to see how this
    // is implemented.
    
    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'acdinner',
        'questiontext' => 'Will you be at the academic dinner?',
        'questiondescr' => NULL,
        'responseformat' => 'radio:Yes|No',
        'responsevalidationlogic' => 'required',
        'html5required' => True,
        'companionresponsevalidationlogic' => NULL,
      ],
    ]);
    $accdinnerguestquestionid = DB::table('rego_questions')->insertGetId([
      'questionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => NULL,
      'questionshortname' => 'acdinnerguest',
      'questiontext' => 'Name of your guest to the academic dinner',
      'questiondescr' => NULL,
      'responseformat' => 'checkbox:OtherText',
      'responsevalidationlogic' => 'required',
      'html5required' => False,
      'companionresponsevalidationlogic' => 'multiothertext',
    ],'questionid');
    
    $accdinnerguestquestionshortname = DB::table('rego_questions')
                        ->where('questionid',$accdinnerguestquestionid)
                        ->value('questionshortname');
    
    DB::table('rego_questions')->insertGetId([
      'questionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => NULL,
      'questionshortname' => 'othersocial',
      'questiontext' => 'Will you be at other social events?',
      'questiondescr' => 'Includes access to the PCP, BBQ and some other events.',
      'responseformat' => 'radio:Yes|No',
      'responsevalidationlogic' => 'required',
      'html5required' => True,
      'companionresponsevalidationlogic' => NULL,
    ],'questionid');
    
                        
    // NEW SECTION
    
    $sectionid = DB::table('rego_sections')->insertGetId([
      'sectionord' => 90,
      'sectionname' => 'Dietary requirements',
      'sectionshortname' => 'food',
      'sectionduplicateforeach' => $accdinnerguestquestionshortname
    ],'sectionid');
    
    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 1,
      'sectionid' => $sectionid,
      'subsectioncode' => 1,
      'subsectionname' => 'Food allergy and intolerance requirements',
      'subsectiondescr' => NULL,
    ],'subsectionid');
    
    $subsectioncode = DB::table('rego_subsections')
                        ->where('subsectionid',$subsectionid)
                        ->value('subsectioncode');
    
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
    
    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 2,
      'sectionid' => $sectionid,
      'subsectioncode' => 2,
      'subsectionname' => 'Food restriction requirements',
      'subsectiondescr' => NULL,
    ],'subsectionid');

    $subsectioncode = DB::table('rego_subsections')
                        ->where('subsectionid',$subsectionid)
                        ->value('subsectioncode');
    
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



    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 3,
      'sectionid' => $sectionid,
      'subsectioncode' => 3,
      'subsectionname' => 'Other food requirements',
      'subsectiondescr' => NULL,
    ],'subsectionid');

    $subsectioncode = DB::table('rego_subsections')
                        ->where('subsectionid',$subsectionid)
                        ->value('subsectioncode');
    
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

    $subsectionid = DB::table('rego_subsections')->insertGetId([
      'subsectionord' => 4,
      'sectionid' => $sectionid,
      'subsectioncode' => 4,
      'subsectionname' => 'Food preferences (non requirements)',
      'subsectiondescr' => NULL,
    ],'subsectionid');

    $subsectioncode = DB::table('rego_subsections')
                        ->where('subsectionid',$subsectionid)
                        ->value('subsectioncode');
      
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
      'sectionord' => 100,
      'sectionname' => 'Merchandise sales',
      'sectionshortname' => 'merchandise'
    ],'sectionid');

    DB::table('rego_questions')->insert([
      [
        'questionord' => 1,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'photo',
        'questiontext' => 'Adelaide IV 2019 festival photograph',
        'questiondescr' => '$15 each',
        'responseformat' => 'text:number',
        'html5required' => False,
        'responsevalidationlogic' => 'nullable|numeric|integer|min:1',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 2,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'cd',
        'questiontext' => 'Adelaide IV 2019 festival concert recording (USB medium)',
        'questiondescr' => '$15 each',
        'responseformat' => 'text:number',
        'html5required' => False,
        'responsevalidationlogic' => 'nullable|numeric|integer|min:1',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 3,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'bottle',
        'questiontext' => 'Adelaide IV 2019 festival water bottle',
        'questiondescr' => 'Select the type of water bottle you’d like to buy (Large 740&nbsp;mL $20, Small 500&nbsp;mL $18) and add it to the list. Write in the custom text (we suggest your first name) to be printed on it, or leave the text field blank.',
        'responseformat' => 'text-var-custom:text:Small red^Small red|Small green^Small green|Small blue^Small blue|Small orange^Small orange|Small black^Small black|Large red^Large red|Large green^Large green|Large blue^Large blue|Large orange^Large orange|Large black^Large black',
        'html5required' => False,
        'responsevalidationlogic' => 'string|nullable',
        'companionresponsevalidationlogic' => NULL,
      ],
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'tshirt',
        'questiontext' => 'Adelaide IV festival T&nbsp;shirt',
        'questiondescr' => '$30 each',
        'responseformat' => 'text-var:number:Extra small^xs|Small^s|Medium^m|Large^l|Extra large^xl|Size 6^s6|Size 8^s8|Size 10^s10|Size 12^s12|Size 14^s14|Size 16^s16|Size 18^s18|Size 20^s20|Size 22^s22|Size 24^s24',
        'html5required' => False,
        'responsevalidationlogic' => 'nullable|numeric|integer|min:1',
        'companionresponsevalidationlogic' => NULL,
      ],
/*
      [
        'questionord' => 4,
        'sectionid' => $sectionid,
        'subsectioncode' => NULL,
        'questionshortname' => 'jumper',
        'questiontext' => 'Adelaide IV jumper personally knitted by Emily',
        'questiondescr' => '$10 each',
        'responseformat' => 'soldout',
        'html5required' => False,
        'responsevalidationlogic' => 'nullable|numeric|integer|min:0',
        'companionresponsevalidationlogic' => NULL,
      ],
*/
    ]);
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
