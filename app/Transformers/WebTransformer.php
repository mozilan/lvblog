<?php

namespace App\Transformers;

use App\Models\Web;
use League\Fractal\TransformerAbstract;

class WebTransformer extends TransformerAbstract
{
    public function transform(Web $web)
    {
        return [
            'title' => $web->title,
            'notice' => $web->notice,
            'message' => $web->message,
            'urgent_message' => $web->urgent_message,
            'author' => $web->author,
            'copyright' => $web->copyright,
            'record' => $web->record,
            'time' => $web->time,
            'IMG_API' => $web->img_api,
        ];
    }
}