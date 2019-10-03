<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;

class ImagesController extends Controller
{
    public function store(Request $request, ImageUploadHandler $uploader)
    {
        $user =  \Auth::guard('api')->user();
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'articles', $user->id, 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
                return $data;
            }
        }
        return response()->json(['message' => '上传失败!'], 400);;
    }
}
