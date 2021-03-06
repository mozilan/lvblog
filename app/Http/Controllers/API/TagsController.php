<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Transformers\TagTransformer;


class TagsController extends Controller
{
    public function index($user_id)
    {
        return $this->response->collection(Tag::where('user_id',$user_id)->get(), new TagTransformer());
    }

    public function all()
    {
        //return 'test';
        return $this->response->collection(Tag::all(), new TagTransformer());
    }
}