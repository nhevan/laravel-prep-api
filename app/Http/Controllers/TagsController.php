<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Lesson;
use Illuminate\Http\Request;
use Acme\Transformers\TagTransformer;

class TagsController extends ApiController
{
	protected $tagTransformer;

	/**
	 * Initiates with a TagTransformer object
	 * @param TagTransformer $tagTransformer 
	 */
	public function __construct(TagTransformer $tagTransformer)
	{
		$this->tagTransformer = $tagTransformer;
	}
    /**
     * lists all tags
     * @return array 
     */
    public function index($lesson_id = null)
    {
    	$tags = $this->getTags($lesson_id);
    	return $this->respond([
    		'data' => $this->tagTransformer->transformCollection($tags->toArray())
		]);
    }

    public function getTags($lesson_id)
    {
    	return $lesson_id ? Lesson::findOrFail($lesson_id)->tags : Tag::all();
    }
}
