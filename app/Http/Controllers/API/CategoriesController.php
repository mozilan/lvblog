<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Requests\Api\CategoryRequest;
use App\Transformers\CategoryTransformer;


class CategoriesController extends Controller
{
    protected $categoryMaxLength = 10;
    public function index($user_id)
    {
        return $this->response->collection(Category::where('user_id',$user_id)->get(), new CategoryTransformer());
    }

    public function store(CategoryRequest $request )
    {
        if(strlen($request->name) > $this->categoryMaxLength){
            return response()->json(['message' => '分类名称不能超过'.$this->categoryMaxLength.'个单位长度'], 422);
        }
        try{
            $maxCountCategory = 10;
            if(Category::where('user_id', $this->user()->id)->count() >= $maxCountCategory){
                return response()->json(['message' => '分类最多只能'.$maxCountCategory.'个'], 422);
            }
            if (Category::where('user_id', $this->user()->id)->where('name',$request->name)->exists()) {
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