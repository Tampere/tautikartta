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
        $validPostCodes = [
            33100,
            33180,
            33200,
            33210,
            33230,
            33240,
            33250,
            33270,
            33300,
            33310,
            33330,
            33340,
            33400,
            33410,
            33420,
            33500,
            33520,
            33530,
            33540,
            33560,
            33580,
            33610,
            33680,
            33700,
            33710,
            33720,
            33730,
            33800,
            33820,
            33840,
            33850,
            33870,
            33900,
            34240,
            34260,
            34270
        ];
        $valid = 0;
        $invalid = 0;
        foreach (file('database/seeds/diag.csv') as $line)
        {
            list($date, $agegroup, $postcode, $icd) = explode(";", $line);

            if(!preg_match('/[0-9]{5}/', $postcode) || !in_array($postcode, $validPostCodes)) {
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
