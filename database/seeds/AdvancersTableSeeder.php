<?php

use Illuminate\Database\Seeder;

class AdvancersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Advancer::class,5000)->create();
    }
}
