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
            list($date, $gender, $postcode, $icd) = explode(";", $line);

            if(!preg_match('/[0-9]{5}/', $postcode)) {
                $invalid++;
                continue;
            }

            Disease::create([
                'date' => $date,
                'gender' => $gender,
                'postcode' => $postcode,
                'icd' => $icd
            ]);

            $valid++;
        }

        echo "valid $valid, invalid $invalid";
    }
}
