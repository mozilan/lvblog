<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class CategoriesController extends Controller
{
    public function index($user_id)
    {
        return $this->response->collection(Category::where('user_id',$user_id)->get(), new CategoryTransformer());
    }
}