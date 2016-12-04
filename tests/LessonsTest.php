<?php 

use Laracasts\TestDummy\Factory as TestDummy;
/**
* Lessons Test class
*/
class LessonsTest extends ApiTester
{
	/** @test */
	public function it_fetches_lessons()
	{
		//arange
		TestDummy::times(20)->create('App\Lesson');

		//act
		$this->getJson('api/lessons');

		//assert
		$this->assertResponseOk();
	}
	/** @test **/
	public function it_also_fetches_a_single_lesson()
	{
		//arange
	    TestDummy::create('App\Lesson');

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
}
?>