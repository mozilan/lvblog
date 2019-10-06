<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    //
    protected $fillable = ['title', 'user_id'];

    public function scopeUser()
    {
        return User::find( $this->user_id);
    }
}
