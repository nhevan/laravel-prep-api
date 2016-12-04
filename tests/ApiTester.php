<?php

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTester extends TestCase
{
    protected $fake;

    public function __construct()
    {
        $this->fake = Faker::create();
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    } 
    /**
     * returns the response Object
     * @param  string $uri example : 'api/lessons/1'
     * @return object 
     */
    public function getData($uri, $method = 'GET')
    {
        return json_decode($this->call($method, $uri)->getContent());
    }

    public function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
}
