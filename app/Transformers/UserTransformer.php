<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'bound_phone' => $user->phone ? true : false,
            'bound_oauth' => $user->provider ? $user->provider : false,
            'created_at' => (string) $user->created_at,
            'updated_at' => (string) $user->updated_at,
            'introduction' => (string) $user->introduction,
        ];
    }
}