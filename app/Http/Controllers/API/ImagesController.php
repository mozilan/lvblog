<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Requests\Api\ImageRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImagesController extends Controller
{
//    public function store(Request $request, ImageUploadHandler $uploader)
//    {
//        $user =  \Auth::guard('api')->user();
//        // 初始化返回数据，默认是失败的
//        $data = [
//            'success'   => false,
//            'msg'       => '上传失败!',
//            'file_path' => ''
//        ];
//        // 判断是否有上传文件，并赋值给 $file
//        if ($file = $request->upload_file) {
//            // 保存图片到本地
//            $result = $uploader->save($request->upload_file, 'articles', $user->id, 1024);
//            // 图片保存成功的话
//            if ($result) {
//                $data['file_path'] = $result['path'];
//                $data['msg']       = "上传成功!";
//                $data['success']   = true;
//                return $data;
//            }
//        }
//        return response()->json(['message' => '上传失败!'], 400);;
//    }
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image)
    {
        $user = $this->user();

        $size = $request->type == 'avatar' ? 362 : 1024;
        $result = $uploader->save($request->image, str_plural($request->type), $user->id, $size);

        $image->path = $result['path'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return $this->response->item($image, new ImageTransformer())->setStatusCode(201);
    }
    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'email', 'introduction']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }
}
