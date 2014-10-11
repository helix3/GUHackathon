<?php

class SasSeeder extends Seeder
{

    public function run()
    {

        ini_set("memory_limit", "7G");
        ini_set('max_execution_time', '0');
        ini_set('max_input_time', '0');
        set_time_limit(0);
        ignore_user_abort(true);
        //DB::connection('mongodb')->table('sas')->delete();


        $this->command->info('Sas destroyed.');

        $file_path = app_path('sas-data.csv');

        $repo = App::make('Hack\Repositories\Sas\SasInterface');

        if (($handle = fopen($file_path, 'r')) !== false) {
            // get the first row, which contains the column-titles (if necessary)
            //$header = fgetcsv($handle);

            // loop through the file line-by-line
            while (($data = fgetcsv($handle)) !== false) {
                $value = $data;
                $day = intval($value[3]) > 0 ? $value[3] : 1;
                $month = intval($value[2]) > 0 ? $value[2] : 1;
                $year = intval($value[1]) >0 ? intval($value[1]) : 1970;


                $this->command->info('Chunk parsed');

                var_dump($day . $month . $year);
                $sas_id = $repo->create(array(
                    'event_id' => $value[0],
                    'date' => \Carbon\Carbon::createFromDate($year, $month, $day),
                    'country' => utf8_encode(utf8_decode($value[8])),
                    'city' => utf8_encode(utf8_decode($value[12])),
                    'lat' => $value[13],
                    'long' => $value[14],
                    'body' => utf8_encode(utf8_decode($value[18])),
                    'attack_type' => utf8_encode(utf8_decode($value[29])),
                    'attack_type_id' => utf8_encode(utf8_decode($value[28])),
                    'target_type' => utf8_encode(utf8_decode($value[35])),
                    'target_type_id' => utf8_encode(utf8_decode($value[34])),
                    'group_name' => utf8_encode(utf8_decode($value[58])),
                    'motive' => utf8_encode(utf8_decode($value[64])),
                    'weapons' => utf8_encode(utf8_decode($value[81])),
                    'weapon_id' => utf8_encode(utf8_decode($value[81])),
                    'cost' => utf8_encode(utf8_decode($value[105])),
                    'notes' => utf8_encode(utf8_decode($value[124])),

                ));

                unset($sas_id);

                // resort/rewrite data and insert into DB here
                // try to use conditions sparingly here, as those will cause slow-performance

                // I don't know if this is really necessary, but it couldn't harm;
                // see also: http://php.net/manual/en/features.gc.php
                unset($data);
            }
            fclose($handle);
        }

        $this->command->info('Sas seeded');
    }

    protected function file_get_contents_chunked($file, $chunk_size, $callback)
    {
        try {
            $handle = fopen($file, "r");
            $i = 0;
            while (!feof($handle)) {
                call_user_func_array($callback, array(fread($handle, $chunk_size), &$handle, $i));
                $i++;
            }

            fclose($handle);

        } catch (Exception $e) {
            trigger_error("file_get_contents_chunked::" . $e->getMessage(), E_USER_NOTICE);
            return false;
        }

        return true;
    }

}