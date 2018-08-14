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
        'itemshortname' => 'fee_camp',
        'itemname' => 'Camp fee',
        'price' => 200,
        'itemord' => 2
      ],
      [
        'itemshortname' => 'rego_accom',
        'itemname' => 'Registration: Camp accommodation',
        'price' => 125,
        'itemord' => 3
      ],
      [
        'itemshortname' => 'camp_linen',
        'itemname' => 'Camp: Linen hire',
        'price' => 18,
        'itemord' => 4
      ],
      [
        'itemshortname' => 'rego_acdinner',
        'itemname' => 'Registration: Academic dinner',
        'price' => 130,
        'itemord' => 5
      ],
      [
        'itemshortname' => 'rego_acdinner_guest',
        'itemname' => 'Registration: Academic dinner (Guest)',
        'price' => 130,
        'itemord' => 6
      ],
      [
        'itemshortname' => 'conc_youth',
        'itemname' => 'Youth concession',
        'price' => -100,
        'itemord' => 7
      ],
      [
        'itemshortname' => 'conc_student',
        'itemname' => 'Student concession',
        'price' => -250,
        'itemord' => 8
      ],
      [
        'itemshortname' => 'disc_fresher',
        'itemname' => 'Registration discount: Fresher',
        'price' => -100,
        'itemord' => 9
      ],
      [
        'itemshortname' => 'fee_late',
        'itemname' => 'Late fee',
        'price' => 50,
        'itemord' => 10
      ],
      [
        'itemshortname' => 'music_arnesen',
        'itemname' => 'Music: Arnesen',
        'price' => 15,
        'itemord' => 11
      ],
      [
        'itemshortname' => 'music_part',
        'itemname' => 'Music: Pärt',
        'price' => 12,
        'itemord' => 12
      ],
      [
        'itemshortname' => 'music_esenvalds',
        'itemname' => 'Music: Ešenvalds',
        'price' => 7,
        'itemord' => 13
      ],
      [
        'itemshortname' => 'music_gjeilo',
        'itemname' => 'Music: Gjeilo',
        'price' => 4,
        'itemord' => 14
      ],
      [
        'itemshortname' => 'music_sandstrom',
        'itemname' => 'Music: Sandström',
        'price' => 4,
        'itemord' => 15
      ],
      [
        'itemshortname' => 'music_dove',
        'itemname' => 'Music: Dove',
        'price' => 5,
        'itemord' => 16
      ],
      [
        'itemshortname' => 'music_lauridsen2',
        'itemname' => 'Music: Lauridsen 2',
        'price' => 4,
        'itemord' => 17
      ],
      [
        'itemshortname' => 'music_lauridsen3',
        'itemname' => 'Music: Lauridsen 3',
        'price' => 3,
        'itemord' => 18
      ],
      [
        'itemshortname' => 'music_whitacre',
        'itemname' => 'Music: Whitacre',
        'price' => 5,
        'itemord' => 19
      ],
      [
        'itemshortname' => 'merch_photo',
        'itemname' => 'Merchandise: Photograph',
        'price' => 15,
        'itemord' => 20
      ],
      [
        'itemshortname' => 'merch_cd',
        'itemname' => 'Merchandise: CD recording',
        'price' => 15,
        'itemord' => 21
      ],
      [
        'itemshortname' => 'merch_wine',
        'itemname' => 'Merchandise: Wine glass',
        'price' => 5,
        'itemord' => 22
      ],
      [
        'itemshortname' => 'merch_bottle_large',
        'itemname' => 'Merchandise: Large water bottle',
        'price' => 20,
        'itemord' => 23
      ],
      [
        'itemshortname' => 'merch_bottle_small',
        'itemname' => 'Merchandise: Small water bottle',
        'price' => 18,
        'itemord' => 24
      ],
      [
        'itemshortname' => 'merch_tshirt',
        'itemname' => 'Merchandise: T shirt',
        'price' => 20,
        'itemord' => 25
      ]
    ]);











    DB::table('rego_flags')->insert([
      [
        'questionshortname' => 'doing',
        'matchtype' => '?',
        'responsematch' => 'singing',
        'purchaseitemshortname' => 'rego_choral',
      ],
      [
        'questionshortname' => 'othersocial',
        'matchtype' => '?',
        'responsematch' => 'yes',
        'purchaseitemshortname' => 'rego_social',
      ],
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
        'matchtype' => 'COUNT',
        'responsematch' => '',
        'purchaseitemshortname' => 'rego_acdinner_guest',
      ],



//// ADDITIONS FROM HERE
      [
        'questionshortname' => 'sleepingatcamp',
        'matchtype' => 'not?',
        'responsematch' => 'no',
        'purchaseitemshortname' => 'rego_accom',
      ],
      [
        'questionshortname' => 'sleepingatcamp',
        'matchtype' => '?',
        'responsematch' => 'yes, with linen hire',
        'purchaseitemshortname' => 'camp_linen',
      ],
      [
        'questionshortname' => 'scorearnesen',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_arnesen',
      ],
      [
        'questionshortname' => 'scorepart',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_part',
      ],
      [
        'questionshortname' => 'scoreesenvalds',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_esenvalds',
      ],
      [
        'questionshortname' => 'scoregjeilo',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_gjeilo',
      ],
      [
        'questionshortname' => 'scoresandstrom',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_sandstrom',
      ],
      [
        'questionshortname' => 'scoredove',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_dove',
      ],
      [
        'questionshortname' => 'scorelauridsenii',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_lauridsen2',
      ],
      [
        'questionshortname' => 'scorelauridseniii',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_lauridsen3',
      ],
      [
        'questionshortname' => 'scorewhitacre',
        'matchtype' => '?',
        'responsematch' => 'buy',
        'purchaseitemshortname' => 'music_whitacre',
      ],
      
      [
        'questionshortname' => 'photo',
        'matchtype' => 'INTEGER',
        'responsematch' => '',
        'purchaseitemshortname' => 'merch_photo',
      ],
      [
        'questionshortname' => 'cd',
        'matchtype' => 'INTEGER',
        'responsematch' => '',
        'purchaseitemshortname' => 'merch_cd',
      ],
      [
        'questionshortname' => 'wineglass',
        'matchtype' => 'INTEGER',
        'responsematch' => '',
        'purchaseitemshortname' => 'merch_wine',
      ],
      [
        'questionshortname' => 'bottle',
        'matchtype' => 'COUNTCHECKBOXWITHCHAR',
        'responsematch' => 'S',
        'purchaseitemshortname' => 'merch_bottle_small',
      ],
      [
        'questionshortname' => 'bottle',
        'matchtype' => 'COUNTCHECKBOXWITHCHAR',
        'responsematch' => 'L',
        'purchaseitemshortname' => 'merch_bottle_large',
      ],
      [
        'questionshortname' => 'tshirt',
        'matchtype' => 'SUMINTEGER',
        'responsematch' => '',
        'purchaseitemshortname' => 'merch_tshirt',
      ]

    ]);










    switch(config('database.default'))
    {
      case('pgsql'):
        // Note: PostgreSQL has a ? operator but this plays havock with
        // Laravel’s binding mechanism. Fortunately, jsonb_exists() saves
        // the day.
        DB::statement("
          CREATE VIEW v_user_rego_items_1 AS
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
                'f'
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
              Bool_and(COALESCE(result,'f')) as includeswitch,
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
            price as unitprice,
            1 as qty,
            price,
            itemord
          from
            c
            natural join
            rego_purchaseitems
          where
            includeswitch = 't'
          order by
            userid,
            itemord");
        DB::statement("
                  CREATE VIEW v_user_rego_items_2 AS
WITH A AS
(

select userid,questionshortname,'' as char,json_array_length((responsejson::jsonb - 'hiddeninput')::json) as qty from rego_responses where questionshortname in (SELECT questionshortname FROM rego_flags WHERE matchtype = 'COUNT')

union

SELECT userid,questionshortname,'' as char,(responsejson#>>'{}')::INTEGER as qty FROM rego_responses WHERE questionshortname in (SELECT questionshortname FROM rego_flags WHERE matchtype = 'INTEGER')

union

select userid,questionshortname,'' as char,sum(value::INTEGER) as qty from rego_responses, json_each_text(responsejson) where questionshortname IN (select questionshortname FROM rego_flags WHERE matchtype = 'SUMINTEGER') group by userid,questionshortname

union

SELECT userid,questionshortname,SUBSTRING(value FROM 1 FOR 1) AS size,COUNT(value) AS qty FROM rego_responses,json_each_text(responsejson#>'{checkbox}') WHERE questionshortname in (select questionshortname from rego_flags where matchtype = 'COUNTCHECKBOXWITHCHAR') group by userid,questionshortname,size

),
B AS (
SELECT
  userid,
  purchaseitemshortname as itemshortname,
 qty
FROM
  A
  JOIN
  rego_flags ON (
    A.questionshortname = rego_flags.questionshortname
    AND responsematch = char
  )
)
SELECT
  userid,
  itemshortname,
  itemname,
  price as unitprice,
  qty,
  qty*price as price,
  itemord
FROM
  B
  NATURAL JOIN
  rego_purchaseitems
WHERE qty IS NOT NULL
ORDER BY
  userid,
  itemord");
        DB::statement("CREATE VIEW v_user_rego_items as select * from v_user_rego_items_1 union select * from v_user_rego_items_2 order by userid,itemord");
        break;
      case('mysql'):
        DB::statement("
          CREATE VIEW v_user_rego_items_1 AS
          select
            userid,
            itemshortname,
            itemname,
            price as unitprice,
            cast(1 as int) as qty,
            price,
            itemord
          from
            (
              SELECT
                userid,
                itemshortname,
                min(result) as includeswitch
              FROM
                ( ---- b
                  select
                    userid,
                    questionshortname,
                    itemshortname,
                    cast(case
                      when matchtype = '?' AND JSON_SEARCH(responsejson,'one',responsematch) IS NOT NULL
                      then 1
                      when matchtype = 'not?' AND JSON_SEARCH(responsejson,'one',responsematch) IS NULL
                      then 1
                      else
                      0
                    end as integer) as result
                  from
                  ( ---- a
                    select
                      userid,
                      questionshortname,
                      matchtype,
                      responsematch,
                      purchaseitemshortname as itemshortname,
                      responsejson
                    from
                      rego_flags
                        cross join
                      (select id as userid from iv_users) z
                        left join
                      rego_responses
                        using (questionshortname,userid)
                    where
                      matchtype in ('?','not?')
                  ) a
                  order by
                    userid
                ) b
              GROUP BY
                userid,
                itemshortname
            ) c
            natural join
            rego_purchaseitems
          where
            includeswitch = 1
          order by
            userid,
            itemord");
        DB::statement("
          CREATE VIEW v_user_rego_items_2 AS
          SELECT
            userid,
            itemshortname,
            itemname,
            price as unitprice,
            qty,
            qty*price as price,
            itemord
          FROM
            (
              SELECT
                userid,
                purchaseitemshortname as itemshortname,
                qty
              FROM
                (
                              (
                                select
                                  userid,
                                  questionshortname,
                                  '' as `char`,
                                  json_length(json_remove(responsejson,json_unquote(json_search(responsejson,'one','hiddeninput')))) as qty
                                from
                                  rego_responses
                                where
                                  questionshortname in (
                                    select questionshortname from rego_flags where matchtype = 'COUNT'
                                  )
                                  and
                                  json_length(json_remove(responsejson,json_unquote(json_search(responsejson,'one','hiddeninput')))) > 0
                              )
                              union
                              (
                                SELECT
                                  userid,
                                  questionshortname,
                                  '' as `char`,
                                  cast(json_unquote(responsejson) as integer) as qty
                                FROM
                                  rego_responses
                                WHERE
                                  questionshortname in (
                                    SELECT questionshortname FROM rego_flags WHERE matchtype = 'INTEGER'
                                  )
                                  AND
                                  json_unquote(responsejson) <> 'null'
                              )
                              union
                              (
                                SELECT
                                  userid,
                                  questionshortname,
                                  '' as `char`,
                                  sum(cast(json_unquote(JSON_EXTRACT(json_extract(responsejson,'$.*'), CONCAT('$[', idx, ']'))) as int)) AS qty
                                FROM rego_responses
                                     JOIN
                                     ( SELECT seq AS idx FROM seq_0_to_99 ) AS indexes
                                WHERE
                                  json_unquote(JSON_EXTRACT(json_extract(responsejson,'$.*'), CONCAT('$[', idx, ']'))) <> 'null'
                                  AND
                                  questionshortname in (select questionshortname from rego_flags where matchtype = 'SUMINTEGER')
                                GROUP BY
                                  userid,questionshortname
                                ORDER BY
                                  userid,foritem,questionshortname
                              )
                              union
                              (
                                select
                                  userid,
                                  questionshortname,
                                  substr(bottletypes from 1 for 1) as `char`,
                                  count(bottletypes) qty
                                from
                                (
                                  select
                                    userid,
                                    questionshortname,
                                    COALESCE(
                                      json_unquote(json_extract(json_extract(responsejson,'$.checkbox'), concat('$.',idx))),
                                      json_unquote(json_extract(json_extract(responsejson,'$.checkbox'), concat('$[',idx,']')))
                                    ) AS bottletypes
                                  from
                                    rego_responses
                                    join
                                    ( SELECT seq AS idx FROM seq_0_to_99 ) AS indexes
                                  where
                                    questionshortname in (
                                      select questionshortname from rego_flags
                                      where matchtype = 'COUNTCHECKBOXWITHCHAR'
                                    )
                                    and
                                    (
                                      json_extract(json_extract(responsejson,'$.checkbox'), concat('$.',idx)) <> 'null'
                                      or
                                      json_extract(json_extract(responsejson,'$.checkbox'), concat('$[',idx,']')) <> 'null'
                                    )
                                ) U
                                group by
                                  userid,
                                  questionshortname,
                                  `char`
                              )
                ) V
                JOIN
                rego_flags ON (
                  V.questionshortname = rego_flags.questionshortname
                  AND responsematch = `char`
                )
            ) B
            NATURAL JOIN
            rego_purchaseitems
          ORDER BY
            userid,
            itemord");
        DB::statement("CREATE VIEW v_user_rego_items as select * from v_user_rego_items_1 union select * from v_user_rego_items_2 order by userid,itemord");
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

        DB::statement("
          CREATE VIEW v_rego_required_sections AS
          (
            SELECT
              userid,
              sectionid,
              coalesce(required,'false') as required
            from
            (
              SELECT DISTINCT
                     userid,
                     sectionid,
                     'true' as required
                FROM rego_responses
                     NATURAL JOIN
                     rego_requirements
                     JOIN rego_sections
                     ON (doasksection = sectionshortname)
               WHERE {$subxnorpqr}
            ) a
            LEFT JOIN
            (
              select id as userid,sectionid
              from iv_users cross join rego_sections
            ) b
            using (userid,sectionid)
          )
          UNION
          (
            SELECT
              userid,
              sectionid,
              coalesce(required,'false') as required
            from
            (
              SELECT DISTINCT
                     userid,
                     sectionid,
                     'true' as required
                FROM rego_responses
                     NATURAL JOIN
                     rego_requirements
                     JOIN rego_sections
                     ON (doasksection = sectionshortname)
               WHERE {$subxnorpqr}
            ) a
            RIGHT JOIN
            (
              select id as userid,sectionid
              from iv_users cross join rego_sections
            ) b
            using (userid,sectionid)
          )
          order by userid;

        ");
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
