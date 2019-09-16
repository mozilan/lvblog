<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['article_id', 'user_id','name'];
    public function articleMapTag()
    {
        return $this->hasMany(ArticleMapTag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

