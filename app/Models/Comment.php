<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable =  ['article_id','fromId','type','fromName','fromAvatar','likeNum','content'];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function reply()
    {
        return $this->hasMany(Reply::class);
    }
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
