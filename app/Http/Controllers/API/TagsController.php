<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Transformers\TagTransformer;


class TagsController extends Controller
{
    public function index($user_id)
    {
        return $this->response->collection(Tag::where('user_id',$user_id)->get(), new TagTransformer());
    }
}