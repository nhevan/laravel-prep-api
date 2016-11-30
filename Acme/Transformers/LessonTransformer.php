<?php

namespace Acme\Transformers;

/**
*
*/
class LessonTransformer extends Transformer
{
    public function transform($lesson)
    {
        return [
                'id' => $lesson['id'],
                'title' => $lesson['title'],
                'body' => $lesson['body'],
            ];
    }
}
