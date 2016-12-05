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
		$this->times(20)->create('App\Lesson');

		//act
		$this->getJson('api/lessons');

		//assert
		$this->assertResponseOk();
	}
	/** @test **/
	public function it_also_fetches_a_single_lesson()
	{
		//arange
	    $this->create('App\Lesson');

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
		$lesson = $this->make('App\Lesson');
	
	    //act
		$this->getData('api/lessons', 'POST', $lesson->toArray());
	
	    //assert
	    $this->assertResponseStatus(201);
	}

	/** @test **/
	public function it_throws_422_if_validation_fails()
	{
		//arrange
	    // $lesson = $this->make('App\Lesson');
	
	    //act
		$this->getData('api/lessons', 'POST');
	
	    //assert
	    $this->assertResponseStatus(422);
	}

	/** @test **/
	public function it_returns_pagination_metadata()
	{
		//arange
		$this->times(20)->create('App\Lesson');

		//act
		$lessons = $this->getData('api/lessons');
		
		//assert
		$this->assertObjectHasAttributes($lessons,  'pagination');
	    
	}

	/** @test **/
	public function by_default_it_returns_5_paginated_data()
	{
		//arrange
	    $this->times(20)->create('App\Lesson');
	
	    //act
		$lessons = $this->getData('api/lessons');
	
	    //assert
	    $this->assertObjectHasAttributes($lessons,  'pagination');
	    $this->assertCount(5, $lessons->data);
	    
	}

	/** @test **/
	public function it_returns_x_no_of_lessons_when_limit_is_x()
	{
		//arrange
		$limit = 3;
	    $this->times(20)->create('App\Lesson');
	
	    //act
		$lessons = $this->getData('api/lessons', 'GET', ['limit' => $limit]);
	
	    //assert
	    $this->assertObjectHasAttributes($lessons,  'pagination');
	    $this->assertCount($limit, $lessons->data);
	}

	/** @test **/
	public function it_returns_default_limit_no_when_limit_value_is_more_than_20()
	{
		//arrange
	    $limit = 25;
	    $this->times(20)->create('App\Lesson');
	
	    //act
		$lessons = $this->getData('api/lessons', 'GET', ['limit' => $limit]);
	
	    //assert
	    $this->assertObjectHasAttributes($lessons,  'pagination');
	    $this->assertCount(5, $lessons->data);
	}
}
?>