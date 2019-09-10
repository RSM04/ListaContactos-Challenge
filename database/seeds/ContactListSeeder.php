<?php

use Illuminate\Database\Seeder;

class ContactListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contactlist')->insert([
            'name' => 'Renato',
            'surname' => 'Montaño',
            'email' => "renatogp13@gmail.com",
            'categories' => '1,2'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Daniel',
            'surname' => 'Gomez',
            'email' => "danielgomez@gmail.com",
            'categories' => '2,3'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Sergio',
            'surname' => 'Piedra',
            'email' => "sergiopiedra@gmail.com",
            'categories' => '3,4'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Wilson',
            'surname' => 'Babolat',
            'email' => "wilsonbabolat@gmail.com",
            'categories' => '1,4'
        ]);
    }
}
