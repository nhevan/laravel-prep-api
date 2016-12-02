<?php 

use App\Tag;
use App\Lesson;

$factory('App\Lesson', [
    'title' => $faker->sentence(3),
    'body' => $faker->paragraph(3)
]);

$factory('App\Tag', [
    'name' => $faker->word()
]);

$factory('App\LessonTag', function($faker){
	$lessonIds = Lesson::pluck('id');
	$tagIds = Tag::pluck('id');
	return [
	    'lesson_id' => $faker->randomElement($lessonIds->toArray()),
	    'tag_id' => $faker->randomElement($tagIds->toArray())
	];
});
