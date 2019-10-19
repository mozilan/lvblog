<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Models\Web;
use App\Transformers\FriendTransformer;
use App\Transformers\WebTransformer;

class WebController extends Controller
{
    //
    public function config()
    {
        $config = Web::all();
        if($config->first()){
            return $this->response->item($config, new WebTransformer());
        }else{
            return response()->json(['message' => '没有网站的配置信息'], 404);
        }
    }

    public function friendShow()
    {
        $friends = Partner::all();
        if($friends->first()){
            return $this->response->collection(Partner::all(),new FriendTransformer());
        }else{
            return response()->json(['message' => '没有友情链接'], 404);
        }

    }
}



