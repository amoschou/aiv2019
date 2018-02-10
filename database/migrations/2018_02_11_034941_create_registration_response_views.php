<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationResponseViews extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement('CREATE VIEW view_rego_responses AS
                     SELECT rego_responses.responseid,
                        rego_responses.userid,
                        rego_responses.questionshortname,
                        rego_responses.responsejson
                       FROM rego_responses
                    UNION ALL
                     SELECT rego_responses_nofk.responseid,
                        rego_responses_nofk.userid,
                        rego_responses_nofk.attributename AS questionshortname,
                        rego_responses_nofk.responsejson
                       FROM rego_responses_nofk');
    switch(config('database.default'))
    {
      case('pgsql'):
        DB::statement("CREATE VIEW view_rego_responses_essential AS
                          WITH t AS
                          (
                               SELECT userid,
                                      (json_agg(responsejson#>>'{}') FILTER (WHERE questionshortname = 'firstname'))->0#>>'{}' firstname,
                                      (json_agg(responsejson#>>'{}') FILTER (WHERE questionshortname = 'lastname'))->0#>>'{}' lastname,
                                      (json_agg(responsejson#>>'{}') FILTER (WHERE questionshortname = 'pronoun'))->0#>>'{}' pronoun,
                                      (json_agg(responsejson#>>'{}') FILTER (WHERE questionshortname = 'pronoun:othertext'))->0#>>'{}' otherpronoun,
                                      (json_agg(responsejson) FILTER (WHERE questionshortname = 'doing'))->0 doing
                                 FROM view_rego_responses
                             GROUP BY userid
                             ORDER BY userid
                          )
                           SELECT firstname,
                                  lastname,
                                  COALESCE(otherpronoun,pronoun) pronoun,
                                  doing
                             FROM t");
        break;
      case('mysql'):
        DB::statement("CREATE VIEW view_rego_responses_essential AS
                           SELECT firstname,
                                  lastname,
                                  COALESCE(otherpronoun,pronoun) pronoun,
                                  doing
                             FROM (
                               SELECT userid,
                                      json_unquote(group_concat(case when questionshortname = 'firstname' then responsejson end)) firstname,
                                      json_unquote(group_concat(case when questionshortname = 'lastname' then responsejson end)) lastname,
                                      json_unquote(group_concat(case when questionshortname = 'pronoun' then responsejson end)) pronoun,
                                      json_unquote(group_concat(case when questionshortname = 'pronoun:othertext' then responsejson end)) otherpronoun,
                                      (group_concat(case when questionshortname = 'doing' then responsejson end)) doing
                                 FROM view_rego_responses
                             GROUP BY userid
                             ORDER BY userid) t");
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
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_essential');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses');
  }
}
