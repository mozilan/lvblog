<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CategoryRequest;
use App\Transformers\CategoryTransformer;


class CategoriesController extends Controller
{
    public function index($user_id)
    {
        return $this->response->collection(Category::where('user_id',$user_id)->get(), new CategoryTransformer());
    }

    public function store(CategoryRequest $request )
    {
        try{
            if (Category::where('user_id', $this->user()->id)->where('name',$request->get('name'))->exists()) {
                return response()->json(['message' => '分类名称已经存在'], 422);
            }
            $category = Category::create([
                'user_id'=> \Auth::guard('api')->user()->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }catch (\Exception $e){
            return response()->json(['message' => '服务器错误'], 500);
        }

        return $this->response->collection(Category::where('user_id',$this->user()->id)->get(), new CategoryTransformer())
        ->setStatusCode(201);
    }

    public function destroy($id)
    {
        try {
            if (Category::where('user_id', $this->user()->id)->where('id',$id)->doesntExist()) {
                return response()->json(['message' => '分类名称不存在'], 422);
            }
            Category::where('user_id', $this->user()->id)->where('id', $id)->delete();
            return $this->response->collection(Category::where('user_id',$this->user()->id)->get(), new CategoryTransformer())
                ->setStatusCode(201);
        }catch (\Exception $e){
            return response()->json(['message' => '服务器错误'], 500);
        }
    }
}