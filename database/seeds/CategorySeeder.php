<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name' => 'Categoria 1',
        ]);
        DB::table('category')->insert([
            'name' => 'Categoria 2',
        ]);
        DB::table('category')->insert([
            'name' => 'Categoria 3',
        ]);
        DB::table('category')->insert([
            'name' => 'Categoria 4',
        ]);
    }
}
