<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DocumentType::create([
        'name' => 'MUHTELIF'
        ]);

        \App\DocumentType::create([
            'name' => 'TETKIK'
        ]);

        \App\User::create([
            'name' => 'EKREM YURDAKUL',
            'email' => 'ekrem@yurdakul.net',
            'password' => bcrypt('123123'),
        ]);

        \App\Patient::create([
            'document_no'=>'221B',
            'name'  =>  'EKREM',
            'surname'  =>  'YURDAKUL',
            'gender'=>'M',
            'dob'=>date('Y-m-d'),

        ]);

        $eksikmus = fopen("hata_kadinlar.txt", "w") or die("Unable to open file!");
        $counter = 0;
        if (($handle = fopen(base_path() . '/kadinlar.csv', "r")) !== false)
        {
            while (($data = fgetcsv($handle, 1000, ";")) !== false)
            {
                try{
                    $document_no = 'K-' . $data[0] . '/' . $data[1];
                    $name = explode(' ',$data[2])[0];
                    $surname = explode(' ',$data[2])[1];

                    \App\Patient::create([
                        'document_no' => $document_no,
                        'name'        => $name,
                        'surname'     => $surname,
                        'gender'      => 'F'
                    ]);

                    $counter++;
                }catch (Exception $ex){
                    fwrite($eksikmus,$counter .' -- ' . $ex->getMessage() . PHP_EOL);
                }

            }
            fclose($handle);
        }

        $eksikmus = fopen("hata_erkekler.txt", "w") or die("Unable to open file!");
        $counter = 0;
        if (($handle = fopen(base_path() . '/erkekler.csv', "r")) !== false)
        {
            while (($data = fgetcsv($handle, 1000, ";")) !== false)
            {
                try{
                    $document_no = 'E-' . $data[0] . '/' . $data[1];
                    $name = explode(' ',$data[2])[0];
                    $surname = explode(' ',$data[2])[1];

                    \App\Patient::create([
                        'document_no' => $document_no,
                        'name'        => $name,
                        'surname'     => $surname,
                        'gender'      => 'M'
                    ]);

                    $counter++;
                }catch (Exception $ex){
                    fwrite($eksikmus,$counter .' -- ' . $ex->getMessage() . PHP_EOL);
                }

            }
            fclose($handle);
        }
    }
}
