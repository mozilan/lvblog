<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    //
    protected $guarded = ['id'];

    public function article()
    {
        return $this->blongTo(Article::class);
    }
}
