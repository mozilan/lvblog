<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['num', 'user_id','name'];
    public function articleMapTag()
    {
        return $this->hasMany(ArticleMapTag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeArticle()
    {
        return Article::whereIn('id', ArticleMapTag::where('tag_id',$this->id)->pluck('article_id')->toArray());
    }
}

