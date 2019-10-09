<?php

namespace App\Transformers;

use App\Models\Archive;
use League\Fractal\TransformerAbstract;

class ArchiveTransformer extends TransformerAbstract
{
    public function transform(Archive $archive)
    {
        return [
            'id' => $archive->id,
            'title' => $archive->title,
            'article_id' => $archive->article_id,
            'created_at' => $archive->created_at->format('Y-m-d'),
            'user' => $archive->User(),
        ];
    }
}