<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}


