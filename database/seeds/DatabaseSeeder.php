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
    }
}
