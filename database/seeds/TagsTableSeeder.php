<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestDummy::times(10)->create('App\Tag');
    }
}
