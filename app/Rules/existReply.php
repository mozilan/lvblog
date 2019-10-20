<?php

namespace App\Rules;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Contracts\Validation\Rule;

class existReply implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    var $coment_id;

    public function __construct($comment_id)
    {
        //
        $this->coment_id = $comment_id;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        //如果当前评论下不存在回复
        if(!Reply::where('comment_id',$this->coment_id)->exists()){
            if($value == Comment::find($this->coment_id)->fromId){
                return true;
            }else{
                return false;
            }
        }
        //如果当前评论下存在回复
        return Reply::where([['comment_id', $this->coment_id], ['fromId', $value]])->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '当前评论下目标用户没有发表回复.';
    }
}
