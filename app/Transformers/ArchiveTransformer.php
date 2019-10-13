<?php

namespace App\Transformers;

use App\Models\Archive;
use League\Fractal\TransformerAbstract;

class ArchiveTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];
    public function transform(Archive $archive)
    {
        return [
            'id' => $archive->id,
            'title' => $archive->title,
            'article_id' => $archive->article_id,
            'created_at' => $archive->created_at->format('Y-m-d'),
        ];
    }
    public function includeUser(Archive $archive)
    {
        return $this->item($archive->user, new UserTransformer());
    }
}