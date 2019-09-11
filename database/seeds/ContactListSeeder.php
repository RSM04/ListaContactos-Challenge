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
            'categories' => 'Categoria 1, Categoria 2'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Daniel',
            'surname' => 'Gomez',
            'email' => "danielgomez@gmail.com",
            'categories' => 'Categoria 2, Categoria 3'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Sergio',
            'surname' => 'Piedra',
            'email' => "sergiopiedra@gmail.com",
            'categories' => 'Categoria 3, Categoria 4'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Wilson',
            'surname' => 'Babolat',
            'email' => "wilsonbabolat@gmail.com",
            'categories' => 'Categoria 1, Categoria 4'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Makamune',
            'surname' => 'Rabute',
            'email' => "Makamune@gmail.com",
            'categories' => 'Categoria 2, Categoria 4'
        ]);
        DB::table('contactlist')->insert([
            'name' => 'Angel',
            'surname' => 'Hernandez',
            'email' => "angelhernandez@gmail.com",
            'categories' => 'Categoria 3, Categoria 2'
        ]);
    }
}
