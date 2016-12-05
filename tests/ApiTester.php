<?php

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTester extends TestCase
{
    protected $fake;
    protected $times = 1;
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
     * @param  array attribute/parameter array
     * @return object 
     */
    public function getData($uri, $method = 'GET', $parameter = [])
    {
        return json_decode($this->call($method, $uri, $parameter)->getContent());
    }

    public function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

    /**
     * Sets the value of times.
     *
     * @param mixed $times the times
     *
     * @return self
     */
    protected function times($times)
    {
        $this->times = $times;

        return $this;
    }
    /**
     * create a object (stores in the DB) x times with provided or default attributes
     * @param  class $object 
     * @param  array  $attributes
     * @return factory array             
     */
    protected function create($object, $attributes = [])
    {
        return factory($object, $this->times)->create($attributes);
    }

    /**
     * Makes a object with all necessary attributes
     * @param  class $object     
     * @param  array  $attributes 
     * @return factory             
     */
    protected function make($object, $attributes = [])
    {
        return factory($object, $this->times)->make($attributes);
    }
}
