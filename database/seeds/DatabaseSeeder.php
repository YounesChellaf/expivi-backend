<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->csv_to_array(public_path().'/60mm.csv',',');
        $i=0;
        $j=1;

        while ($i < count($data)){
            $row= $data[$i];
            while ($j < count(array_keys($row))){
                //dd($row[array_keys($row)[$j]]);
                DB::table('prices')->insert(
                    array(
                            'length' => array_keys($row)[$j],
                            'width' => $row[array_keys($row)[0]],
                            'price' => $row[array_keys($row)[$j]],
                    )
                );
                $j++;
            }
            $j=1;
            $i++;
        }
        // $this->call(UserSeeder::class);
    }
}
