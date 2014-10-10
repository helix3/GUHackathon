<?php

class TagSeeder extends Seeder {

    public function run()
    {
        DB::connection('mongodb')->table('sas')->delete();

        $this->command->info('Sas destroyed.');

        $file_path = app_path('sas-data.csv');

        $repo = App::make('Hack\Repositories\Sas\SasInterface');

        $csv = array_map('str_getcsv', file($file_path));

        foreach (File::files($file_path) as $key => $value) {

            $sas_id = $repo->create(array(

                'event_id' => $value[0],
                'date'     => \Carbon\Carbon::create($value[3].'-'.$value[2].'-'.$value[3]),
                'country'  => $value[8],
                'city'     => $value[12],
                'lat'      => $value[13],
                'long'     => $value[14],
                'body'     => $value[18],
                'attack_type' => $value[29],


            ));


        }






       	$this->command->info('Sas seeded');
    }

}