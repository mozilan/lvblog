<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    //
    protected $fillable = ['title', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
