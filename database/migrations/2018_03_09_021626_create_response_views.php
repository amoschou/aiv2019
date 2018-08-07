<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseViews extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    switch(config('database.default'))
    {
      case('pgsql'):
        $Q = "CREATE VIEW v_rego_fileuploads AS
                SELECT
                  userid,
                  foritem,
                  questionshortname,
                  json_array_elements(responsejson->'uploadedfiles')->>0 AS key,
                  json_array_elements(responsejson->'uploadedfiles')->>1 AS filename,
                  json_array_elements(responsejson->'uploadedfiles')->>2 AS mimetype,
                  json_array_elements(responsejson->'uploadedfiles')->>3 AS b64contents
                FROM
                  rego_responses
                ORDER BY
                  userid,foritem,questionshortname";
        break;
      case('mysql'):
        $Q = "CREATE VIEW v_rego_fileuploads AS
                SELECT
                  userid,
                  foritem,
                  questionshortname,
                  JSON_EXTRACT(responsejson, CONCAT('$.uploadedfiles[', idx, '][0]')) AS `key`,
                  JSON_EXTRACT(responsejson, CONCAT('$.uploadedfiles[', idx, '][1]')) AS filename,
                  JSON_EXTRACT(responsejson, CONCAT('$.uploadedfiles[', idx, '][2]')) AS mimetype,
                  JSON_EXTRACT(responsejson, CONCAT('$.uploadedfiles[', idx, '][3]')) AS b64contents
                FROM rego_responses
                     JOIN
                     ( SELECT seq AS idx FROM seq_0_to_99 ) AS indexes
                WHERE
                  JSON_EXTRACT(responsejson, CONCAT('$.uploadedfiles[', idx, ']')) IS NOT NULL
                ORDER BY
                  userid,foritem,questionshortname";
        break;
    }
    DB::statement($Q);
    
    switch(config('database.default'))
    {
      case('pgsql'):
        Schema::create('rego_purchaseitems', function (Blueprint $table) {
          $table->increments('itemid');
          $table->text('itemshortname')->unique();
          $table->text('itemname')->unique();
          $table->decimal('price',8,2);
          $table->integer('itemord')->nullable();
        });
        Schema::create('rego_flags', function (Blueprint $table) {
          $table->text('questionshortname');
          $table->text('matchtype');
          $table->text('responsematch');
          $table->string('purchaseitemshortname');
          $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
          $table->foreign('purchaseitemshortname')->references('itemshortname')->on('rego_purchaseitems');
        });
        break;
      case('mysql'):
        Schema::create('rego_purchaseitems', function (Blueprint $table) {
          $table->increments('itemid');
          $table->string('itemshortname')->unique();
          $table->string('itemname')->unique();
          $table->decimal('price',8,2);
          $table->integer('itemord')->nullable();
        });
        Schema::create('rego_flags', function (Blueprint $table) {
          $table->string('questionshortname');
          $table->text('matchtype');
          $table->text('responsematch');
          $table->string('purchaseitemshortname');
          $table->foreign('questionshortname')->references('questionshortname')->on('rego_questions');
          $table->foreign('purchaseitemshortname')->references('itemshortname')->on('rego_purchaseitems');
        });
        break;
    }
    DB::table('rego_purchaseitems')->insert([
      [
        'itemshortname' => 'rego_choral',
        'itemname' => 'Registration: Choral participation',
        'price' => 425,
        'itemord' => 0
      ],
      [
        'itemshortname' => 'rego_social',
        'itemname' => 'Registration: Social participation',
        'price' => 20,
        'itemord' => 1
      ],
      [
        'itemshortname' => 'rego_accom',
        'itemname' => 'Registration: Camp accommodation',
        'price' => 125,
        'itemord' => 2
      ],
      [
        'itemshortname' => 'rego_acdinner',
        'itemname' => 'Registration: Academic dinner',
        'price' => 130,
        'itemord' => 3
      ],
      [
        'itemshortname' => 'conc_youth',
        'itemname' => 'Youth concession',
        'price' => -100,
        'itemord' => 4
      ],
      [
        'itemshortname' => 'conc_student',
        'itemname' => 'Student concession',
        'price' => -250,
        'itemord' => 5
      ],
      [
        'itemshortname' => 'disc_fresher',
        'itemname' => 'Registration discount: Fresher',
        'price' => -100,
        'itemord' => 6
      ],
      [
        'itemshortname' => 'fee_late',
        'itemname' => 'Late fee',
        'price' => 50,
        'itemord' =>7
      ],
      [
        'itemshortname' => 'rego_acdinner_guest',
        'itemname' => 'Registration: Academic dinner (Guest)',
        'price' => 130,
        'itemord' => 8
      ],
      [
        'itemshortname' => 'merch_tshirt',
        'itemname' => 'Merchandise: T shirt (%)',
        'price' => 20,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_bottle_large_2',
        'itemname' => 'Merchandise: Large water bottle with two custom words (%, %)',
        'price' => 24,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_bottle_large_1',
        'itemname' => 'Merchandise: Large water bottle with one custom word (%, %)',
        'price' => 22,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_bottle_large_0',
        'itemname' => 'Merchandise: Large water bottle without custom words (%, %)',
        'price' => 20,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_bottle_small_2',
        'itemname' => 'Merchandise: Small water bottle with two custom words (%, %)',
        'price' => 19,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_bottle_small_1',
        'itemname' => 'Merchandise: Small water bottle with one custom words (%, %)',
        'price' => 17,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_bottle_small_0',
        'itemname' => 'Merchandise: Small water bottle without custom words (%, %)',
        'price' => 15,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_photo',
        'itemname' => 'Merchandise: Photograph',
        'price' => 15,
        'itemord' => NULL
      ],
      [
        'itemshortname' => 'merch_cd',
        'itemname' => 'Merchandise: CD recording',
        'price' => 15,
        'itemord' => NULL
      ]
    ]);











    DB::table('rego_flags')->insert([
      [
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'singing',
        'purchaseitemshortname' => 'rego_choral',
      ],
/*
      [
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'social',
        'purchaseitemshortname' => 'rego_social',
      ],
*/
      [
        'questionshortname' => 'othersocial',
        'matchtype' => '?',
        'responsematch' => 'yes',
        'purchaseitemshortname' => 'rego_social',
      ],
/*
      [      
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'social',
        'purchaseitemshortname' => 'rego_acdinner',
      ],
*/
      [
        'questionshortname' => 'acdinner',
        'matchtype' => '?',
        'responsematch' => 'yes',
        'purchaseitemshortname' => 'rego_acdinner',
      ],


      [
        'questionshortname' => 'concession',
        'matchtype' => '?',
        'responsematch' => 'youth',
        'purchaseitemshortname' => 'conc_youth',
      ],
      [
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'singing',
        'purchaseitemshortname' => 'conc_youth',
      ],
      // If student is one of your concessions, then the youth discount is not applied
      [
        'questionshortname' => 'concession',
        'matchtype' => 'not?',
        'responsematch' => 'student',
        'purchaseitemshortname' => 'conc_youth',
      ],


      [
        'questionshortname' => 'concession',
        'matchtype' => '?',
        'responsematch' => 'student',
        'purchaseitemshortname' => 'conc_student',
      ],
      [
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'singing',
        'purchaseitemshortname' => 'conc_student',
      ],
      [
        'questionshortname' => 'fresher',
        'matchtype' => '?',
        'responsematch' => 'yes',
        'purchaseitemshortname' => 'disc_fresher',
      ],
      [
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'singing',
        'purchaseitemshortname' => 'disc_fresher',
      ],
      [
        'questionshortname' => 'acdinnerguest',
        'matchtype' => 'COUNTFROMZERO',
        'responsematch' => '%',
        'purchaseitemshortname' => 'rego_acdinner_guest',
      ],
    ]);










    switch(config('database.default'))
    {
      case('pgsql'):
        // Note: PostgreSQL has a ? operator but this plays havock with
        // Laravel’s binding mechanism. Fortunately, jsonb_exists() saves
        // the day.
        DB::statement("
          CREATE VIEW v_user_rego_items AS
          WITH a AS
          (
            select
              id as userid,
              questionshortname,
              matchtype,
              responsematch,
              purchaseitemshortname
            from
              rego_flags
              cross join
              iv_users
          ),
          b AS
          (
            select
              questionshortname,
              matchtype,
              purchaseitemshortname as itemshortname,
              case
                when matchtype = '?'
                then jsonb_exists(responsejson::jsonb,responsematch)
                when matchtype = 'not?'
                then NOT (jsonb_exists(responsejson::jsonb,responsematch))
                else
                false
              end as result,
              responseid,
              userid
            from
              a
              left join
              rego_responses
              using (questionshortname,userid)
            order by
              userid
          ),
          c as
          (
            SELECT
              userid,
              itemshortname,
              Bool_and(COALESCE(result,'f')) as include,
              itemord
            FROM
              b
              join
              rego_purchaseitems using (itemshortname)
            GROUP BY
              userid,
              itemshortname,
              itemord
          )
          select
            userid,
            itemshortname,
            itemname,
            price,
            itemord
          from
            c
            natural join
            rego_purchaseitems
          where
            include = 't'
          order by
            userid,
            itemord");
        break;
      case('mysql'):
        break;
    }
    
    
    
    
    
    
    switch(config('database.default'))
    {
      case('pgsql'):
        DB::statement("
          CREATE VIEW v_rego_required_sections AS
          WITH a AS
          (
          SELECT DISTINCT
                 userid,
                 sectionid,
                 'true'::BOOLEAN as required
            FROM rego_responses
                 NATURAL JOIN
                 rego_requirements
                 JOIN rego_sections
                 ON (doasksection = sectionshortname)
           WHERE CASE
                   WHEN comparisonoperator = 'LIKE'
                   THEN responsejson::TEXT LIKE responsepattern
                   WHEN comparisonoperator = '?'
                   THEN jsonb_exists(responsejson::JSONB,responsepattern)
                 END
          ),
          b AS
          (
            select id as userid,sectionid
            from iv_users cross join rego_sections
          )
          SELECT
            userid,
            sectionid,
            coalesce(required,'false') as required
          from
            a
            FULL OUTER JOIN
            b using (userid,sectionid)
          order by userid
        ");
        break;
      case('mysql'):
         // Wow MySQL, just wow.
         $suba = "(comparisonoperator = 'LIKE')";
         $subb = "(CAST(responsejson AS CHAR) LIKE responsepattern)";
         $subc = "(comparisonoperator = '?')";
         $subd = "(JSON_SEARCH(responsejson,'one',responsepattern) IS NOT NULL)";
         $subp = "((NOT $suba) OR $subb)";
         $subq = "($suba OR (NOT $subc) OR $subd)";
         $subr = "($suba OR $subc)";
         $subxnorpqr = "(($subp AND $subq AND $subr) OR ((NOT $subp) AND (NOT $subq) AND (NOT $subr)))";
/*
         DB::statement("
            CREATE VIEW v_rego_required_sections AS
            SELECT
              userid,
              sectionid,
              coalesce(required,CAST('false' AS BOOLEAN)) as required
            from
            (
              SELECT DISTINCT
                     userid,
                     sectionid,
                     'true' as required
                FROM rego_responses
                     NATURAL JOIN
                     rego_requirements
               WHERE {$subxnorpqr}
            ) a
            FULL OUTER JOIN
            (
              select id as userid,sectionid
              from iv_users cross join rego_sections
            ) b
            using (userid,sectionid)
            order by userid
          ");
*/
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
    DB::statement('DROP VIEW IF EXISTS v_rego_required_sections');
    DB::statement('DROP VIEW IF EXISTS v_user_rego_items');
    Schema::dropIfExists('rego_flags');
    Schema::dropIfExists('rego_purchaseitems');
    DB::statement('DROP VIEW IF EXISTS v_rego_fileuploads');
  }
}
