<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $fillable =  ['comment_id','from_id','fromName','fromAvatar','toId','toName','toAvatar','content'];
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class,'fromId','id');
    }
    public function toUser()
    {
        return $this->belongsTo(User::class,'toId','id');
    }
}
