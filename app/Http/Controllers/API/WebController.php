<?php

namespace App\Http\Controllers\Api;

use App\Models\Web;
use App\Transformers\WebTransformer;

class WebController extends Controller
{
    //
    public function config()
    {
        return $this->response->item(Web::all()->first(), new WebTransformer());
    }
}



