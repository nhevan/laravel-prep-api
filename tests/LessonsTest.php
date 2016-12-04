<?php 

/**
* Lessons Test class
*/
class LessonsTest extends ApiTester
{
	/** @test */
	public function it_fetches_lessons()
	{
		//arange
		factory(App\Lesson::class, 20)->create();

		//act
		$this->getJson('api/lessons');

		//assert
		$this->assertResponseOk();
	}
	/** @test **/
	public function it_also_fetches_a_single_lesson()
	{
		//arange
	    factory(App\Lesson::class)->create();
	    
	    //act
	    $lesson = $this->getData('api/lessons/1');

	    //assert
	    $this->assertResponseOk();
	    $this->assertObjectHasAttributes($lesson->data, 'body', 'title');
	    // $this->assertObjectHasAttribute('title', $lesson);
	}
	/** @test **/
	public function it_returns_404_for_nonexistant_lesson()
	{
		//arrange
	    //act
		$this->getData('api/lessons/x');
	
	    //assert
	    $this->assertResponseStatus(404);
	}

	/** @test **/
	public function it_creates_a_new_lesson_given_valid_parameters()
	{
		//arrange
		
		// $l = factory('App\Lesson')->make();
		// var_dump($l);
		// exit();

	    // $this->getData('api/lessons', 'POST')
	
	    //act
		
	
	    //assert
	    
	}
}
?>