<?php

use App\Disease;
use Illuminate\Database\Seeder;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valid = 0;
        $invalid = 0;
        foreach (file('database/seeds/diag.csv') as $line)
        {
            list($date, $agegroup, $postcode, $icd) = explode(";", $line);

            if(!preg_match('/[0-9]{5}/', $postcode) || $postcode < '33100' || $postcode > '34270') {
                $invalid++;
                continue;
            }

            Disease::create([
                'date' => \Carbon\Carbon::createFromFormat('Ymd H:i:s', $date . ' 00:00:00'),
                'agegroup' => $agegroup,
                'postcode' => $postcode,
                'icd' => $icd
            ]);

            $valid++;
        }

        echo "valid $valid, invalid $invalid";
    }
}
