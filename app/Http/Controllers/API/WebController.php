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
        return $this->response->item(Web::all()->first(), new WebTransformer());
    }

    public function friendShow()
    {
        return $this->response->collection(Partner::all(),new FriendTransformer());
    }
}



