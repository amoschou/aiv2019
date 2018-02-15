<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankingController extends Controller
{
  public function index()
  {
    $csvformat = ['date','description','debit','credit','balance'];
    $folder = new \DirectoryIterator(__DIR__ . '/../../../downloads/banksa');
    foreach($folder as $file)
    {
      if($file->isFile())
      {
        $pathname = $file->getPathname();
        $handle = fopen($pathname,'r');
        if($handle !== False)
        {
          $i = 0;
          fgetcsv($handle); // Forget the header row
          while(($line = fgetcsv($handle)) !== FALSE)
          {
            // Make sure incomplete lines (eg blank line at EOF) are excluded
            if(count($line) === count($csvformat))
            {
              $csv[$i] = [];
              for($j = 0; $j < count($line); $j++)
              {
                switch($j)
                {
                  case(0):
                    $val = implode('-',array_reverse(explode('/',$line[0])));
                    break;
                  case(1):
                    $val = $line[$j];
                    break;
                  default:
                    $val = $line[$j] === '' ? '0.00' : $line[$j];
                    break;
                }
                $csv[$i][$csvformat[$j]] = $val;
              }
            }
            $i++;
          }
          fclose($handle);
        }
      }
    }
    $csv = array_reverse($csv); // Chronological order.
    switch(config('database.default'))
    {
      case('pgsql'):
        $q = 'INSERT INTO bank_transactions
              (date,description,debit,credit,balance)
              VALUES (:date,:description,:debit,:credit,:balance)
              ON CONFLICT DO NOTHING';
        break;
      case('mysql'):
        $q = 'INSERT IGNORE INTO bank_transactions
              (date,description,debit,credit,balance)
              VALUES (:date,:description,:debit,:credit,:balance)';
        break;
    }
    foreach($csv as $line)
    {
      DB::insert($q,$line);
    }
  }
}
