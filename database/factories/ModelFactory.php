<?php

use App\Tag;
use App\Lesson;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
	    'body' => $faker->paragraph(3)
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word()
    ];
});

$factory->define(App\LessonTag::class, function (Faker\Generator $faker) {
    $lessonIds = Lesson::pluck('id');
	$tagIds = Tag::pluck('id');
	return [
	    'lesson_id' => $faker->randomElement($lessonIds->toArray()),
	    'tag_id' => $faker->randomElement($tagIds->toArray())
	];
});
