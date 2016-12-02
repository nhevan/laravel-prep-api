<?php

use App\Tag;
use App\Lesson;
use App\LessonTag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * @var array
	 */
	private $tables = [
		'lessons',
		'tags',
		'lesson_tag'
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->clearDb();
    	
        $this->call('LessonsTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('LessonTagTableSeeder');
    }

    /**
     * Clear entire database
     * @return void 
     */
    public function clearDb()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	foreach ($this->tables as $tableName) {
    		DB::table($tableName)->truncate();
    	}
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
