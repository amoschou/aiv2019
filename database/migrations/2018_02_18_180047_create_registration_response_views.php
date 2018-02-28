<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationResponseViews extends Migration
{

  public function create_view_rego_responses($db,$viewname,$columns,$types)
  {
    if(count($columns) !== count($types))
    {
      return FALSE;
    }
    // BEGIN INNER TABLE DEFINITION
      $t = 'select userid';
      $cols = 'userid';
      $skipnext = False;
      for($i = 0 ; $i < count($columns) ; $i++)
      {
        $col = $columns[$i];
        if(substr($col,0,1) === '*')
        {
          $col = substr($col,1);
          $cols .= ", CASE WHEN {$col} = 'othertext' THEN other{$col} ELSE {$col} END {$col}";
          $skipnext = True;
        }
        else
        {
          if($skipnext === False)
          {
            $cols .= ", $col";
          }
          $skipnext = False;
        }
        if($types[$i] === 'single' && $db === 'pgsql')
        {
          $t .= ", (json_agg(responsejson#>>'{}') FILTER (WHERE questionshortname = '{$col}'))->0#>>'{}' {$col}";
        }
        if($types[$i] === 'multi' && $db === 'pgsql')
        {
          $t .= ", (json_agg(responsejson) FILTER (WHERE questionshortname = '{$col}'))->0 {$col}";
        }
        if($types[$i] === 'single' && $db === 'mysql')
        {
          $t .= ", json_unquote(group_concat(case when questionshortname = '{$col}' then responsejson end)) {$col}";
        }
        if($types[$i] === 'multi' && $db === 'mysql')
        {
          $t .= ", (group_concat(case when questionshortname = '{$col}' then responsejson end)) {$col}";
        }
      }
      $t .= ' FROM view_rego_responses GROUP BY userid ORDER BY userid';
    // END INNER TABLE DEFINITION
    
    $q = 'CREATE VIEW view_rego_responses_'.  $viewname . ' AS ';
    switch($db)
    {
      case('pgsql'):
        $q .= 'WITH t AS (' . $t . ') SELECT ' . $cols . ' FROM t';
        break;
      case('mysql'):
        $q .= 'SELECT ' . $cols . ' FROM (' . $t . ') t';
        break;
    }
    return $q;
  }

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
    
    $qs = [];
    
    $qs[] = $this->create_view_rego_responses(
      config('database.default'),
      'essential',
      ['firstname','lastname','*pronoun','otherpronoun','doing','adelaide'],
      ['single','single','single','single','multi','single']);
    
    $qs[] = $this->create_view_rego_responses(
      config('database.default'),
      'personal',
      ['phonebefore','phoneduring','post','aicsachoirs','nonaicsachoirs'],
      ['single','single','single','multi','multi']);
    
    $qs[] = $this->create_view_rego_responses(
      config('database.default'),
      'emergency',
      ['emergencyname','emergencyrelationship','emergencyphone','emergencyadditions'],
      ['single','single','single','single']);
      
    $qs[] = $this->create_view_rego_responses(
      config('database.default'),
      'food',
      ['gf','badfood','precautions','badfoodplan','veg','animalproducts','otherfood','complexfood','foodprefs'],
      ['single','multi','single','single','single','multi','single','single','single']);
      
    $qs[] = $this->create_view_rego_responses(
      config('database.default'),
      'choral',
      ['voice','divisi','sometimessings'],
      ['single','single','multi']);
      
    foreach($qs as $q)
    {
      DB::statement($q);
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_permission');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_merchandise');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_social');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_billeting');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_cba');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_travel');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_choral');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_food');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_emergency');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_personal');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses_essential');
    DB::statement('DROP VIEW IF EXISTS view_rego_responses');
  }
}
