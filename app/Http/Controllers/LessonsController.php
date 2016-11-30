<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Acme\Transformers\LessonTransformer;

class LessonsController extends Controller
{
    protected $lesson;
    protected $lessonTransformer;
    public function __construct(Lesson $lesson, LessonTransformer $lessonTransformer)
    {
        $this->lesson = $lesson;
        $this->lessonTransformer = $lessonTransformer;
    }
    public function index()
    {
        $lessons = $this->lesson->all();

        return response([
            'data'=>$this->lessonTransformer->transformCollection($lessons->toArray())
        ]);
    }

    public function show(Lesson $lesson)
    {
        return response([
            'data'=> $this->lessonTransformer->transform($lesson)
        ]);
    }
}
