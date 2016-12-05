<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Acme\Transformers\LessonTransformer;

class LessonsController extends ApiController
{
    protected $lesson;
    
    /**
     * Acme/Transformers/lessonTransformer
     * @var lessonTransformer
     */
    protected $lessonTransformer;

    public function __construct(Lesson $lesson, LessonTransformer $lessonTransformer)
    {
        $this->lesson = $lesson;
        $this->lessonTransformer = $lessonTransformer;
    }

    /**
     * lists all lessons
     * @return response lessons array
     */
    public function index(Request $request)
    {
        $limit = (int)$request->limit ?: 5;
        $lessons = $this->lesson->paginate($limit);
        
        return $this->respondWithPagination($lessons, $this->lessonTransformer);
    }

    /**
     * shows a specific lesson
     * @param  int $id lesson's id
     * @return response
     */
    public function show($id)
    {
        $lesson = $this->lesson->find($id);
        if (!$lesson) {
            return $this->responseNotFound('Lesson does not exist.');
        }
        return $this->respond([
            'data'=> $this->lessonTransformer->transform($lesson)
        ]);
    }
    /**
     * stores a new lesson
     * @param  Request $request 
     * @return Response         
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
        ];
        if (!$this->setRequest($request)->isValidated($rules)) {
        	return $this->responseValidationError();
        }
        $this->lesson->create($request->all());
        return $this->respondCreated('Lesson Created Successfully.');
    }
}
