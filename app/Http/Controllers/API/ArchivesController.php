<?php

namespace App\Http\Controllers\Api;

use App\Models\Archive;
use App\Models\User;
use App\Transformers\ArchiveTransformer;

class ArchivesController extends Controller
{
    //
    public function index($user_id)
    {
        $archive = Archive::where('user_id',$user_id)->recent()->get();
        return $this->response->collection($archive, new ArchiveTransformer())
            ->setMeta([
                'count' => $archive->count(),
                'user' => User::find($user_id),
            ]);
    }
}
